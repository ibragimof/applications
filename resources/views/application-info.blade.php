<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Personal Information') }}
        </h5>
    </div>

    <div class="card-body">
        <x-core::datagrid>
            <x-core::datagrid.item>
                <x-slot:title>{{ trans('plugins/applications::application.form.full_name') }}</x-slot:title>
                {{ $application->name }}
            </x-core::datagrid.item>

            <x-core::datagrid.item>
                <x-slot:title>{{ trans('plugins/applications::application.form.email') }}</x-slot:title>
                {{ Html::mailto($application->email) }}
            </x-core::datagrid.item>

            @if ($application->phone)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.phone') }}</x-slot:title>
                    <a href="tel:{{ $application->phone }}">{{ $application->phone }}</a>
                </x-core::datagrid.item>
            @endif

            <x-core::datagrid.item>
                <x-slot:title>{{ trans('plugins/applications::application.form.time') }}</x-slot:title>
                {{ $application->created_at->translatedFormat('d M Y H:i:s') }}
            </x-core::datagrid.item>


            @if ($application->gender)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.gender') }}</x-slot:title>
                    {!! $application->gender->toHtml() !!}
                </x-core::datagrid.item>
            @endif

            @if ($application->citizenship)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.citizenship') }}</x-slot:title>
                    {{ $application->citizenship }}
                </x-core::datagrid.item>
            @endif

            @if ($application->date_of_birth)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.date_of_birth') }}</x-slot:title>
                    {{ $application->date_of_birth->translatedFormat('d M Y') }}
                </x-core::datagrid.item>
            @endif

            @if ($application->country)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.country') }}</x-slot:title>
                    {{ $application->country }}
                </x-core::datagrid.item>
            @endif

            @if ($application->region)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.region') }}</x-slot:title>
                    {{ $application->region }}
                </x-core::datagrid.item>
            @endif

            @if($application->address)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.address') }}</x-slot:title>
                    {{ $application->address }}
                </x-core::datagrid.item>
            @endif
        </x-core::datagrid>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Education') }}
        </h5>
    </div>

    <div class="card-body">
        <x-core::datagrid>
            @if($application->known_languages && is_array($application->known_languages))
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.languages') }}</x-slot:title>
                    {{ implode(', ', $application->known_languages) }}
                </x-core::datagrid.item>
            @endif

            @if($application->education_university)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.university') }}</x-slot:title>
                    {{ $application->education_university }}
                </x-core::datagrid.item>
            @endif

            @if($application->education_degree)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.degree') }}</x-slot:title>
                    {!! $application->education_degree->toHtml() !!}
                </x-core::datagrid.item>
            @endif

            @if($application->education_faculty)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.faculty') }}</x-slot:title>
                    {{ $application->education_faculty }}
                </x-core::datagrid.item>
            @endif

            @if($application->education_specialization)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.specialization') }}</x-slot:title>
                    {{ $application->education_specialization }}
                </x-core::datagrid.item>
            @endif

            @if($application->education_started_at)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.started_at') }}</x-slot:title>
                    {{ $application->education_started_at->translatedFormat('d M Y') }}
                </x-core::datagrid.item>
            @endif

            @if($application->education_ended_at)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.ended_at') }}</x-slot:title>
                    {{ $application->education_ended_at->translatedFormat('d M Y') }}
                </x-core::datagrid.item>
            @endif

            @if($application->additional_education)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.additional_education') }}</x-slot:title>
                    {{ $application->additional_education }}
                </x-core::datagrid.item>
            @endif

            @if($application->education_diploma_file && Storage::disk('public')->exists($application->education_diploma_file))
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.diploma') }}</x-slot:title>
                    <a download="{{ Str::snake($application->name) . '_diploma.' .  pathinfo(Storage::disk('public')->path($application->education_diploma_file), PATHINFO_EXTENSION) }}" href="{{ Storage::disk('public')->url($application->education_diploma_file) }}">{{ trans('plugins/applications::application.form.download_diploma') }}</a>
                </x-core::datagrid.item>
            @endif
        </x-core::datagrid>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Work Experience') }}
        </h5>
    </div>

    <div class="card-body">
        <x-core::datagrid>
            @if($application->work_experience_last_workplace)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.last_workplace') }}</x-slot:title>
                    {{ $application->work_experience_last_workplace }}
                </x-core::datagrid.item>
            @endif

            @if($application->work_experience_position)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.position') }}</x-slot:title>
                    {{ $application->work_experience_position }}
                </x-core::datagrid.item>
            @endif

            @if($application->work_experience_started_at)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.started_at') }}</x-slot:title>
                    {{ $application->work_experience_started_at->translatedFormat('d M Y') }}
                </x-core::datagrid.item>
            @endif

            @if($application->work_experience_ended_at)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.ended_at') }}</x-slot:title>
                    {{ $application->work_experience_ended_at->translatedFormat('d M Y') }}
                </x-core::datagrid.item>
            @endif

            @if($application->work_experience_later_workplaces)
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.later_workplaces') }}</x-slot:title>
                    {{ $application->work_experience_later_workplaces }}
                </x-core::datagrid.item>
            @endif

            @if($application->cv_file && Storage::disk('public')->exists($application->cv_file))
                <x-core::datagrid.item>
                    <x-slot:title>{{ trans('plugins/applications::application.form.diploma') }}</x-slot:title>
                    <a download="{{ Str::snake($application->name) . '_cv.' . pathinfo(Storage::disk('public')->path($application->cv_file), PATHINFO_EXTENSION) }}" href="{{ Storage::disk('public')->url($application->cv_file) }}">{{ trans('plugins/applications::application.form.download_cv') }}</a>
                </x-core::datagrid.item>
            @endif
        </x-core::datagrid>
    </div>
</div>

@if($application->social_activity_organization || $application->social_activity_type)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">
                {{ __('Social activity') }}
            </h5>
        </div>

        <div class="card-body">
            <x-core::datagrid>
                @if($application->social_activity_organization)
                    <x-core::datagrid.item>
                        <x-slot:title>{{ trans('plugins/applications::application.form.organization') }}</x-slot:title>
                        {{ $application->social_activity_organization }}
                    </x-core::datagrid.item>
                @endif

                @if($application->social_activity_type)
                    <x-core::datagrid.item>
                        <x-slot:title>{{ trans('plugins/applications::application.form.type') }}</x-slot:title>
                        {{ $application->social_activity_type }}
                    </x-core::datagrid.item>
                @endif
            </x-core::datagrid>
        </div>
    </div>
@endif

@if($application->motivation_essay)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">
                {{ __('Why do you want to become a fellow of the Teach for Uzbekistan program?') }}
            </h5>
        </div>

        <div class="card-body">
            {!! BaseHelper::clean($application->motivation_essay) !!}
        </div>
    </div>
@endif

@if($application->value_proposition_essay)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">
                {{ __('What do you think is your value for children and for the school?') }}
            </h5>
        </div>

        <div class="card-body">
            {!! BaseHelper::clean($application->value_proposition_essay) !!}
        </div>
    </div>
@endif

@if($application->benefit_essay)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">
                {{ __('How can the experience of fellowship in the program benefit you?') }}
            </h5>
        </div>

        <div class="card-body">
            {!! BaseHelper::clean($application->benefit_essay) !!}
        </div>
    </div>
@endif

<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Are you ready to work full-time from September 1 of next academic year, without combining participation in the program with other activities?') }}
        </h5>
    </div>

    <div class="card-body">
        {{ $application->is_available_full_time ? __('Yes') : __('No') }}
    </div>
</div>

<div class="card mb-3">
    <div class="card-header">
        <h5 class="card-title">
            {{ __('Will you be able to participate in the Summer Institute which will last for 5 weeks in the next July-August (participation in it is mandatory to participate in the program)?') }}
        </h5>
    </div>

    <div class="card-body">
        {{ $application->can_attend_summer_institute ? __('Yes') : __('No') }}
    </div>
</div>
