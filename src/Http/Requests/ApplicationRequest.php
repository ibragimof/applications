<?php

namespace Quinton\Applications\Http\Requests;

use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;
use Quinton\Applications\Enums\EducationDegreeEnum;
use Quinton\Applications\Enums\GenderEnum;

class ApplicationRequest extends Request
{
    public function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:24'],
            'last_name' => ['required', 'string', 'min:2', 'max:24'],
            'middle_name' => ['nullable', 'string'],
            'email' => ['nullable', 'email', 'max:80'],
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'citizenship' => ['required', 'string', 'min:2', 'max:48'],
            'date_of_birth' => ['required', 'date'],
            'country' => ['required', 'string', 'min:2', 'max:48'],
            'region' => ['nullable', 'string', 'max:255'],
            'address' => ['required', 'string', 'min:2'],
            'known_languages' => ['required', 'array'],
            'education_university' => ['required', 'string', 'min:2', 'max:255'],
            'education_degree' => ['required', 'string', Rule::in(EducationDegreeEnum::values())],
            'education_faculty' => ['required', 'string', 'min:2', 'max:255'],
            'education_specialization' => ['nullable', 'string', 'min:2', 'max:255'],
            'education_started_at' => ['required', 'date'],
            'education_ended_at' => ['required', 'date'],
            'additional_education' => ['nullable', 'string', 'min:2'],
            'education_diploma_file' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png,doc,docx,heic', 'max:10240'],
            'work_experience_last_workplace' => ['nullable', 'string', 'min:2', 'max:255'],
            'work_experience_later_workplaces' => ['nullable', 'string', 'min:2', 'max:255'],
            'work_experience_position' => ['nullable', 'string', 'min:2', 'max:255'],
            'work_experience_started_at' => ['nullable', 'date'],
            'work_experience_ended_at' => ['nullable', 'date'],
            'cv_file' => ['file', 'mimes:pdf,jpg,jpeg,png,doc,docx,heic', 'max:10240'],
            'social_activity_organization' => ['nullable', 'string', 'max:255'],
            'social_activity_type' => ['nullable', 'string', 'max:255'],
            'motivation_essay' => ['required', 'string', 'min:400', 'max:3000'],
            'value_proposition_essay' => ['required', 'string', 'min:400', 'max:3000'],
            'benefit_essay' => ['required', 'string', 'min:400', 'max:3000'],
            'is_available_full_time' => ['sometimes', 'accepted:1'],
            'can_attend_summer_institute' => ['sometimes', 'accepted:1'],
            'agreed_to_terms' => ['sometimes', 'accepted:1'],
            'gender' => ['required', 'string', Rule::in(GenderEnum::values())],
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => __('plugins/applications::application.form.first_name'),
            'last_name' => __('plugins/applications::application.form.last_name'),
            'middle_name' => __('plugins/applications::application.form.middle_name'),
            'email' => __('plugins/applications::application.form.email'),
            'phone' => __('plugins/applications::application.form.phone'),
            'citizenship' => __('plugins/applications::application.form.citizenship'),
            'date_of_birth' => __('plugins/applications::application.form.date_of_birth'),
            'country' => __('plugins/applications::application.form.country'),
            'region' => __('plugins/applications::application.form.region'),
            'address' => __('plugins/applications::application.form.address'),
            'known_languages' => __('plugins/applications::application.form.known_languages'),
            'education_university' => __('plugins/applications::application.form.university'),
            'education_degree' => __('plugins/applications::application.form.degree'),
            'education_faculty' => __('plugins/applications::application.form.faculty'),
            'education_specialization' => __('plugins/applications::application.form.specialization'),
            'education_started_at' => __('plugins/applications::application.form.education_started_at'),
            'education_ended_at' => __('plugins/applications::application.form.education_ended_at'),
            'additional_education' => __('plugins/applications::application.form.additional_education'),
            'education_diploma_file' => __('plugins/applications::application.form.education_diploma_file'),
            'work_experience_last_workplace' => __('plugins/applications::application.form.work_experience_last_workplace'),
            'work_experience_later_workplaces' => __('plugins/applications::application.form.work_experience_later_workplaces'),
            'work_experience_position' => __('plugins/applications::application.form.work_experience_position'),
            'work_experience_started_at' => __('plugins/applications::application.form.work_experience_started_at'),
            'work_experience_ended_at' => __('plugins/applications::application.form.work_experience_ended_at'),
            'cv_file' => __('plugins/applications::application.form.cv_file'),
            'social_activity_organization' => __('plugins/applications::application.form.social_activity_organization'),
            'social_activity_type' => __('plugins/applications::application.form.social_activity_type'),
            'motivation_essay' => __('plugins/applications::application.form.motivation_essay'),
            'value_proposition_essay' => __('plugins/applications::application.form.value_proposition_essay'),
            'benefit_essay' => __('plugins/applications::application.form.benefit_essay'),
            'is_available_full_time' => __('plugins/applications::application.form.is_available_full_time'),
            'can_attend_summer_institute' => __('plugins/applications::application.form.can_attend_summer_institute'),
            'agreed_to_terms' => __('plugins/applications::application.form.agreed_to_terms'),
            'gender' => __('plugins/applications::application.form.gender'),
        ];
    }
}
