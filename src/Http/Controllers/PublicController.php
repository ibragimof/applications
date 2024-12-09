<?php

namespace Quinton\Applications\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Http\Controllers\BaseController;
use Botble\Support\Services\Cache\Cache;
use Exception;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Quinton\Applications\Events\SentApplicationEvent;
use Quinton\Applications\Forms\Fronts\ApplicationForm;
use Quinton\Applications\Http\Requests\ApplicationRequest;
use Quinton\Applications\Models\Application;

class PublicController extends BaseController
{
    public function postSendApplication(ApplicationRequest $request)
    {
        $blacklistDomains = setting('blacklist_email_domains');

        if ($blacklistDomains) {
            $emailDomain = Str::after(strtolower($request->input('email')), '@');

            $blacklistDomains = collect(json_decode($blacklistDomains, true))->pluck('value')->all();

            if (in_array($emailDomain, $blacklistDomains)) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage(__('Your email is in blacklist. Please use another email address.'));
            }
        }

        $blacklistWords = trim(setting('blacklist_keywords', ''));

        if ($blacklistWords) {
            $content = strtolower($request->input('content'));

            $badWords = collect(json_decode($blacklistWords, true))
                ->filter(function ($item) use ($content) {
                    $matches = [];
                    $pattern = '/\b' . preg_quote($item['value'], '/') . '\b/iu';

                    return preg_match($pattern, $content, $matches, PREG_UNMATCHED_AS_NULL);
                })
                ->pluck('value')
                ->all();

            if (! empty($badWords)) {
                return $this
                    ->httpResponse()
                    ->setError()
                    ->setMessage(__('Your message contains blacklist words: ":words".', ['words' => implode(', ', $badWords)]));
            }
        }

        do_action('form_extra_fields_validate', $request, ApplicationRequest::class);

        $receiverEmails = null;

        if ($receiverEmailsSetting = setting('receiver_emails', '')) {
            $receiverEmails = trim($receiverEmailsSetting);
        }

        if ($receiverEmails) {
            $receiverEmails = collect(json_decode($receiverEmails, true))
                ->pluck('value')
                ->all();
        }

        if (is_array($receiverEmails)) {
            $receiverEmails = array_filter($receiverEmails);

            if (count($receiverEmails) === 1) {
                $receiverEmails = Arr::first($receiverEmails);
            }
        }

        try {
            $cache = Cache::make(Application::class);

            $cache->forget('unread-applications');
            $cache->forget('unread-applications-count');

            $form = ApplicationForm::create();

            $form->saving(function (ApplicationForm $form) use ($receiverEmails, $request): void {
                $data = $form->getRequestData();

                $directory = 'applications';
                if (! Storage::disk('public')->exists($directory)) {
                    Storage::disk('public')->makeDirectory($directory);
                }

                if ($request->hasFile('education_diploma_file')) {
                    $file = $request->file('education_diploma_file');
                    $data['education_diploma_file'] = Storage::disk('public')->putFileAs(
                        'applications',
                        $file,
                        'diploma_' . Str::uuid()->toString() . '.' . $file->getClientOriginalExtension()
                    );
                }

                if ($request->hasFile('cv_file')) {
                    $file = $request->file('cv_file');

                    $data['cv_file'] = Storage::disk('public')->putFileAs(
                        'applications',
                        $file,
                        'cv_' . Str::uuid()->toString() . '.' . $file->getClientOriginalExtension()
                    );
                }

                $form
                    ->getModel()
                    ->fill($data)
                    ->save();

                /**
                 * @var Application $application
                 */
                $application = $form
                    ->getModel();

                event(new SentApplicationEvent($application));

                $args = [];

                if ($application->name && $application->email) {
                    $args = ['replyTo' => [$application->name => $application->email]];
                }

                $emailHandler = EmailHandler::setModule(APPLICATION_MODULE_SCREEN_NAME)
                    ->setVariableValues([
                        'application_name' => $application->name,
                        'application_email' => $application->email,
                        'application_phone' => $application->phone,
                        'application_address' => $application->address,
                    ]);

                $emailHandler->sendUsingTemplate('application-notice', $receiverEmails ?: null, $args);

                if ($application->email) {
                    $args = ['replyTo' => is_array($receiverEmails) ? Arr::first($receiverEmails) : $receiverEmails];

                    $emailHandler->sendUsingTemplate('application-sender-confirmation', $application->email, $args);
                }
            });

            return $this
                ->httpResponse()
                ->setMessage(__('plugins/applications::application.messages.send_application_success'));
        } catch (ValidationException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            BaseHelper::logError($exception);

            return $this
                ->httpResponse()
                ->setError()
                ->setMessage(__('plugins/applications::application.messages.send_application_error'));
        }
    }
}
