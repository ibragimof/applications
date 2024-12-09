<div class="nav-item dropdown d-none d-md-flex me-2">
    <button
        class="nav-link px-0"
        data-bs-toggle="dropdown"
        type="button"
        aria-label="{{ trans('plugins/applications::application.dropdown_show_label') }}"
        tabindex="-1"
    >
        <x-core::icon name="ti ti-mail" />
        <span class="badge bg-red text-red-fg badge-pill">{{ number_format($applications->count()) }}</span>
    </button>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
        <x-core::card>
            <x-core::card.header>
                <x-core::card.title>{!! BaseHelper::clean(trans('plugins/applications::application.new_application_notice', ['count' => $applications->count()])) !!}</x-core::card.title>
                <x-core::card.actions>
                    <a href="{{ route('applications.index') }}">{{ trans('plugins/applications::application.view_all') }}</a>
                </x-core::card.actions>
            </x-core::card.header>
            <div
                class="list-group list-group-flush list-group-hoverable overflow-auto"
                style="max-height: 35rem"
            >
                @foreach ($applications as $application)
                    <a href="{{ route('applications.edit', $application->id) }}" class="text-decoration-none">
                        <div class="list-group-item">
                            <div class="row">
                                <div class="col-auto">
                                    <img
                                        class="avatar"
                                        src="{{ $application->avatar_url }}"
                                        alt="{{ $application->name }}"
                                    >
                                </div>
                                <div class="col align-items-center">
                                    <p class="text-truncate mb-2">
                                        {{ $application->name }}
                                        <time
                                            class="small text-muted"
                                            title="{{ $createdAt = BaseHelper::formatDateTime($application->created_at) }}"
                                            datetime="{{ $createdAt }}"
                                        >
                                            {{ $createdAt }}
                                        </time>
                                    </p>
                                    <p class="text-secondary text-truncate mt-n1 mb-0">
                                        {{ implode(' - ', [$application->phone, $application->email]) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
            @if ($applications->count() > 10)
                <x-core::card.footer class="text-center border-top">
                    <a href="{{ route('applications.index') }}">{{ trans('plugins/applications::application.view_all') }}</a>
                </x-core::card.footer>
            @endif
        </x-core::card>
    </div>
</div>
