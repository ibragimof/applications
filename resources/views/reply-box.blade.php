@if ($application)
    <div id="reply-wrapper" class="mb-3">
        @if ($application->replies->isNotEmpty())
            @foreach ($application->replies as $reply)
                <x-core::form.fieldset>
                    <p>{{ trans('plugins/contact::contact.tables.time') }}: <i>{{ BaseHelper::formatDateTime($reply->created_at) }}</i></p>
                    <p>{{ trans('plugins/contact::contact.tables.content') }}:</p>
                    {!! BaseHelper::clean($reply->message) !!}
                </x-core::form.fieldset>
            @endforeach
        @else
            <div class="text-muted">{{ trans('plugins/applications::application.no_comments') }}</div>
        @endif
    </div>

    <x-core::button type="button" class="answer-trigger-button">
        {{ trans('plugins/applications::application.comment') }}
    </x-core::button>

    <div class="answer-wrapper mt-3">
        <input
            type="hidden"
            value="{{ $application->id }}"
            id="input_contact_id"
        >

        <div class="mb-3">
            {!! Form::editor('message', null, ['without-buttons' => true, 'class' => 'form-control']) !!}
        </div>

        <x-core::button
            type="button"
            color="primary"
            icon="ti ti-send"
            class="answer-send-button"
            data-url="{{ route('applications.reply', $application->id) }}"
        >
            {{ trans('plugins/applications::application.send') }}
        </x-core::button>
    </div>
@endif
