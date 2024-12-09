<?php

namespace Quinton\Applications\Forms\Fronts;

use Botble\Base\Forms\FieldOptions\ButtonFieldOption;
use Botble\Base\Forms\FieldOptions\CheckboxFieldOption;
use Botble\Base\Forms\FieldOptions\HtmlFieldOption;
use Botble\Base\Forms\FieldOptions\InputFieldOption;
use Botble\Base\Forms\FieldOptions\MultiChecklistFieldOption;
use Botble\Base\Forms\FieldOptions\SelectFieldOption;
use Botble\Base\Forms\FieldOptions\TextareaFieldOption;
use Botble\Base\Forms\FieldOptions\TextFieldOption;
use Botble\Base\Forms\Fields\HtmlField;
use Botble\Base\Forms\Fields\MultiCheckListField;
use Botble\Base\Forms\Fields\OnOffCheckboxField;
use Botble\Base\Forms\Fields\SelectField;
use Botble\Base\Forms\Fields\TextareaField;
use Botble\Base\Forms\Fields\TextField;
use Botble\Theme\FormFront;
use Illuminate\Contracts\Support\Arrayable;
use Quinton\Applications\Enums\EducationDegreeEnum;
use Quinton\Applications\Enums\GenderEnum;
use Quinton\Applications\Http\Requests\ApplicationRequest;
use Quinton\Applications\Models\Application;

class ApplicationForm extends FormFront
{
    protected ?string $formInputWrapperClass = 'application-form-group form-group';

    protected ?string $formInputClass = 'application-form-input form-control';

    public static function formTitle(): string
    {
        return trans('plugins/applications::application.form.title');
    }

    public function setup(): void
    {
        $dateFormat = strtolower(convert_date_format(theme_option('date_format', 'Y-m-d')));

        $this
            ->contentOnly()
            ->model(Application::class)
            ->setUrl(route('public.send.application'))
            ->setValidatorClass(ApplicationRequest::class)
            ->setFormOption('class', 'application-form')
            ->columns()
            ->add('personal_section_open_wrapper', HtmlField::class, HtmlFieldOption::make()->colspan(2)->content('<div class="application-form-section"><h3 class="title mb-3">' . trans('plugins/applications::application.form.personal_information') . '</h3>'))
            ->add('personal_section_close_wrapper', HtmlField::class, HtmlFieldOption::make()->content('</div>'))
            ->add(
                'first_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/applications::application.form.first_name'))
                    ->required()
            )
            ->add(
                'last_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/applications::application.form.last_name'))
                    ->required()
            )
            ->add(
                'middle_name',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/applications::application.form.middle_name'))
            )
            ->add(
                'gender',
                SelectField::class,
                SelectFieldOption::make()
                    ->choices(GenderEnum::labels())
                    ->label(trans('plugins/applications::application.form.gender'))
                    ->required()
            )
            ->add('citizenship', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.citizenship'))->required())
            ->add(
                'date_of_birth',
                TextField::class,
                TextFieldOption::make()
                    ->addAttribute('class', 'datepicker')
                    ->addAttribute('data-date-format', $dateFormat)
                    ->label(trans('plugins/applications::application.form.date_of_birth'))
                    ->required()
            )
            ->add(
                'phone',
                TextField::class,
                TextFieldOption::make()
                    ->label(trans('plugins/applications::application.form.phone'))
                    ->placeholder('+000 00 000 00 00')
                    ->required()
            )
            ->add('email', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.email')))
            ->add('country', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.country'))->required())
            ->add('region', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.region')))
            ->add('address', TextareaField::class, TextareaFieldOption::make()->colspan(2)->label(trans('plugins/applications::application.form.address'))->required())
            ->add('education_section_open_wrapper', HtmlField::class, HtmlFieldOption::make()->colspan(2)->content('<div class="application-form-section"><h3 class="title mb-3">' . trans('plugins/applications::application.form.education') . '</h3>'))
            ->add('education_section_close_wrapper', HtmlField::class, HtmlFieldOption::make()->content('</div>'))
            ->add(
                'known_languages[]',
                MultiCheckListField::class,
                MultiChecklistFieldOption::make()
                    ->choices([
                        'English' => __('English'),
                        'Russian' => __('Russian'),
                        'Uzbek' => __('Uzbek'),
                    ])
                    ->label(trans('plugins/applications::application.form.known_languages'))
                    ->colspan(2)
                    ->required()
            )
            ->add('education_university', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.university'))->required())
            ->add(
                'education_degree',
                SelectField::class,
                SelectFieldOption::make()
                    ->choices(EducationDegreeEnum::labels())
                    ->label(trans('plugins/applications::application.form.degree'))
                    ->required()
            )
            ->add('education_faculty', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.faculty'))->required())
            ->add('education_specialization', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.specialization')))
            ->add(
                'education_started_at',
                TextField::class,
                TextFieldOption::make()
                    ->addAttribute('class', 'datepicker')
                    ->addAttribute('data-date-format', $dateFormat)
                    ->label(trans('plugins/applications::application.form.started_at'))->required()
            )
            ->add(
                'education_ended_at',
                TextField::class,
                TextFieldOption::make()
                    ->addAttribute('class', 'datepicker')
                    ->addAttribute('data-date-format', $dateFormat)
                    ->label(trans('plugins/applications::application.form.ended_at'))
                    ->required()
            )
            ->add(
                'education_diploma_file',
                'file',
                InputFieldOption::make()::make()
                    ->colspan(2)
                    ->label(trans('plugins/applications::application.form.education_diploma_file'))
                    ->required()
            )
            ->add('additional_education', TextareaField::class, TextareaFieldOption::make()->colspan(2)->label(trans('plugins/applications::application.form.additional_education')))
            ->add('work_experience_section_open_wrapper', HtmlField::class, HtmlFieldOption::make()->colspan(2)->content('<div class="application-form-section"><h3 class="title mb-3">' . trans('plugins/applications::application.form.work_experience') . '</h3>'))
            ->add('work_experience_section_close_wrapper', HtmlField::class, HtmlFieldOption::make()->content('</div>'))
            ->add('work_experience_last_workplace', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.last_workplace')))
            ->add('work_experience_position', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.position')))
            ->add(
                'work_experience_started_at',
                TextField::class,
                TextFieldOption::make()
                    ->addAttribute('class', 'datepicker')
                    ->addAttribute('data-date-format', $dateFormat)
                    ->label(trans('plugins/applications::application.form.work_experience_started_at'))
            )
            ->add(
                'work_experience_ended_at',
                TextField::class,
                TextFieldOption::make()
                    ->addAttribute('class', 'datepicker')
                    ->addAttribute('data-date-format', $dateFormat)
                    ->label(trans('plugins/applications::application.form.work_experience_ended_at'))
            )
            ->add('cv_file', 'file', InputFieldOption::make()->label(trans('plugins/applications::application.form.cv_file')))
            ->add('work_experience_later_workplaces', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.later_workplaces')))
            ->add('social_activity_section_open_wrapper', HtmlField::class, HtmlFieldOption::make()->colspan(2)->content('<div class="application-form-section"><h3 class="title mb-3">' . trans('plugins/applications::application.form.social_activity') . '</h3>'))
            ->add('social_activity_section_close_wrapper', HtmlField::class, HtmlFieldOption::make()->content('</div>'))
            ->add('social_activity_organization', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.organization')))
            ->add('social_activity_type', TextField::class, TextFieldOption::make()->label(trans('plugins/applications::application.form.type')))
            ->add('participation_in_program_section_open_wrapper', HtmlField::class, HtmlFieldOption::make()->colspan(2)->content('<div class="application-form-section"><h3 class="title mb-3">' . trans('plugins/applications::application.form.participation_in_program') . '</h3>'))
            ->add('participation_in_program_section_close_wrapper', HtmlField::class, HtmlFieldOption::make()->content('</div>'))
            ->add('motivation_essay', TextareaField::class, TextareaFieldOption::make()->colspan(2)->label(trans('plugins/applications::application.form.motivation_essay_question'))->required())
            ->add('value_proposition_essay', TextareaField::class, TextareaFieldOption::make()->colspan(2)->label(trans('plugins/applications::application.form.value_proposition_essay_question'))->required())
            ->add('benefit_essay', TextareaField::class, TextareaFieldOption::make()->colspan(2)->label(trans('plugins/applications::application.form.benefit_essay_question'))->required())
            ->add(
                'is_available_full_time',
                OnOffCheckboxField::class,
                CheckboxFieldOption::make()
                    ->colspan(2)
                    ->label(trans('plugins/applications::application.form.available_full_time_question'))
                    ->required()
            )
            ->add(
                'can_attend_summer_institute',
                OnOffCheckboxField::class,
                CheckboxFieldOption::make()
                    ->colspan(2)
                    ->label(trans('plugins/applications::application.form.can_attend_summer_institute_question'))
                    ->required()
            )
            ->add(
                'agreed_to_terms',
                OnOffCheckboxField::class,
                CheckboxFieldOption::make()
                    ->colspan(2)
                    ->label(trans('plugins/applications::application.form.agreed_to_terms_question'))
                    ->required()
            )
            ->addWrappedField(
                'submit',
                'submit',
                ButtonFieldOption::make()
                    ->cssClass('btn')
                    ->label(trans('plugins/applications::application.form.send_application'))
            )
            ->addWrappedField(
                'messages',
                HtmlField::class,
                HtmlFieldOption::make()
                    ->content(<<<'HTML'
                        <div class="application-message application-success-message" style="display: none"></div>
                        <div class="application-message application-error-message" style="display: none"></div>
                    HTML)
            )
        ;
    }

    protected function addWrappedField(string $name, string $type, array|Arrayable $options): static
    {
        $this->add(
            "open_{$name}_field_wrapper",
            HtmlField::class,
            HtmlFieldOption::make()
                ->colspan(2)
                ->content('<div class="application-form-group">')
        );

        $this->add($name, $type, $options);

        return $this->add(
            "close_{$name}_field_wrapper",
            HtmlField::class,
            HtmlFieldOption::make()->content('</div>')
        );
    }
}
