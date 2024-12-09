<?php

namespace Quinton\Applications\Providers;

use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Base\Supports\ServiceProvider;
use Botble\Shortcode\Compilers\Shortcode;
use Botble\Shortcode\Facades\Shortcode as ShortcodeFacade;
use Botble\Shortcode\Forms\ShortcodeForm;
use Botble\Theme\Facades\Theme;
use Botble\Theme\FormFrontManager;
use Quinton\Applications\Forms\Fronts\ApplicationForm;
use Quinton\Applications\Http\Requests\ApplicationRequest;

class HookServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        FormFrontManager::register(ApplicationForm::class, ApplicationRequest::class);

        if (class_exists(ShortcodeFacade::class)) {
            ShortcodeFacade::register(
                'application-form',
                trans('plugins/applications::application.shortcode_name'),
                trans('plugins/applications::application.shortcode_description'),
                [$this, 'form']
            );

            ShortcodeFacade::setAdminConfig('application-form', function (array $attributes) {
                return ShortcodeForm::createFromArray($attributes)
                    ->add('form_title', TextField::class, TextFieldOption::make()->label(__('Title')))
                    ->add('form_description', TextareaField::class, TextareaFieldOption::make()->label(__('Description')));
            });
        }
    }

    public function form(Shortcode $shortcode): string
    {
        $view = apply_filters(APPLICATION_FORM_TEMPLATE_VIEW, 'plugins/applications::forms.application');

        if (defined('THEME_OPTIONS_MODULE_SCREEN_NAME')) {
            $this->app->booted(function (): void {
                Theme::asset()
                    ->usePath(false)
                    ->add('application-css', asset('vendor/core/plugins/applications/css/application-public.css'), [], [], '1.0.0');

                Theme::asset()
                    ->usePath(false)
                    ->add('bootstrap-datepicker-css', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.standalone.min.css', [], [], '1.0.0');

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'applications-public-js',
                        asset('vendor/core/plugins/applications/js/application-public.js'),
                        ['jquery'],
                        [],
                        '1.0.0'
                    );

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'application-public-js',
                        asset('vendor/core/plugins/applications/js/form.js'),
                        ['jquery', 'bootstrap-datepicker-js'],
                        [],
                        '1.0.0'
                    );

                Theme::asset()
                    ->container('footer')
                    ->usePath(false)
                    ->add(
                        'bootstrap-datepicker-js',
                        '//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js',
                        ['jquery'],
                        [],
                        '1.0.0'
                    );
            });
        }

        if ($shortcode->view && view()->exists($shortcode->view)) {
            $view = $shortcode->view;
        }

        $form = ApplicationForm::createFromArray($shortcode->toArray());

        return view($view, compact('shortcode', 'form'))->render();
    }
}
