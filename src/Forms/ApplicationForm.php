<?php

namespace Quinton\Applications\Forms;

use Botble\Base\Facades\Assets;
use Botble\Base\Forms\FieldOptions\StatusFieldOption;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\FormAbstract;
use Quinton\Applications\Enums\ApplicationStatusEnum;
use Quinton\Applications\Http\Requests\EditApplicationRequest;
use Quinton\Applications\Models\Application;

class ApplicationForm extends FormAbstract
{
    public function setup(): void
    {
        Assets::addScriptsDirectly('vendor/core/plugins/applications/js/application.js')
            ->addStylesDirectly('vendor/core/plugins/applications/css/application.css');

        $metaBoxes = [
            'information' => [
                'title' => trans('plugins/applications::application.application_information'),
                'content' => view('plugins/applications::application-info', ['application' => $this->getModel()])->render(),
            ],
        ];

        if ($this->getModel()) {
            $metaBoxes['replies'] = [
                'title' => trans('plugins/applications::application.comments'),
                'content' => view('plugins/applications::reply-box', ['application' => $this->getModel()])->render(),
            ];
        }

        $this
            ->model(Application::class)
            ->setValidatorClass(EditApplicationRequest::class)
            ->add(
                'status',
                SelectField::class,
                StatusFieldOption::make()
                    ->choices(ApplicationStatusEnum::labels())
            )
            ->setBreakFieldPoint('status')
            ->addMetaBoxes($metaBoxes);
    }
}
