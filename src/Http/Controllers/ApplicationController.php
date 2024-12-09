<?php

namespace Quinton\Applications\Http\Controllers;

use Botble\Base\Facades\BaseHelper;
use Botble\Base\Http\Actions\DeleteResourceAction;
use Botble\Base\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Validation\ValidationException;
use Quinton\Applications\Forms\ApplicationForm;
use Quinton\Applications\Http\Requests\ApplicationReplyRequest;
use Quinton\Applications\Http\Requests\EditApplicationRequest;
use Quinton\Applications\Models\Application;
use Quinton\Applications\Models\ApplicationReply;
use Quinton\Applications\Tables\ApplicationTable;

class ApplicationController extends BaseController
{
    public function index(ApplicationTable $table)
    {
        $this->pageTitle(trans('plugins/applications::application.name'));

        return $table->renderTable();
    }

    public function edit(Application $application)
    {
        $this
            ->breadcrumb()
            ->add(trans('plugins/applications::application.name'), route('applications.index'));

        $this->pageTitle(trans('plugins/applications::application.edit'));

        return ApplicationForm::createFromModel($application)->renderForm();
    }

    public function update(Application $application, EditApplicationRequest $request)
    {
        ApplicationForm::createFromModel($application)->setRequest($request)->save();

        Cache::forget('unread-applications-count');
        Cache::forget('unread-applications');

        return $this
            ->httpResponse()
            ->setPreviousRoute('applications.index')
            ->withUpdatedSuccessMessage();
    }

    public function destroy(Application $application)
    {
        return DeleteResourceAction::make($application);
    }

    public function postReply(Application $application, ApplicationReplyRequest $request)
    {
        $message = BaseHelper::clean($request->input('message'));

        if (! $message) {
            throw ValidationException::withMessages(['message' => trans('validation.required', ['attribute' => 'message'])]);
        }

        ApplicationReply::query()->create([
            'message' => $message,
            'application_id' => $application->getKey(),
        ]);

        return $this
            ->httpResponse()
            ->setMessage(trans('plugins/applications::application.message_sent_success'));
    }
}
