<?php

namespace Quinton\Applications\Providers;

use Botble\Base\Facades\DashboardMenu;
use Botble\Base\Facades\EmailHandler;
use Botble\Base\Supports\DashboardMenuItem;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Support\Services\Cache\Cache;
use Illuminate\Routing\Events\RouteMatched;
use Quinton\Applications\Enums\ApplicationStatusEnum;
use Quinton\Applications\Models\Application;

class ApplicationsServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function boot(): void
    {
        $this
            ->setNamespace('plugins/applications')
            ->loadHelpers()
            ->loadAndPublishConfigurations(['permissions', 'email'])
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->loadMigrations()
            ->publishAssets();

        add_filter(BASE_FILTER_TOP_HEADER_LAYOUT, [$this, 'registerTopHeaderNotification'], 120);
        add_filter(BASE_FILTER_APPEND_MENU_NAME, [$this, 'getUnreadCount'], 120, 2);
        add_filter(BASE_FILTER_MENU_ITEMS_COUNT, [$this, 'getMenuItemCount'], 120);

        DashboardMenu::default()->beforeRetrieving(function (): void {
            DashboardMenu::make()
                ->registerItem(
                    DashboardMenuItem::make()
                        ->id('cms-plugins-application')
                        ->priority(130)
                        ->name('plugins/applications::application.name')
                        ->icon('ti ti-mail')
                        ->route('applications.index')
                );
        });

        $this->app->booted(function (): void {
            $this->app->register(HookServiceProvider::class);
        });

        $this->app['events']->listen(RouteMatched::class, function (): void {
            EmailHandler::addTemplateSettings(APPLICATION_MODULE_SCREEN_NAME, config('plugins.applications.email', []));
        });
    }

    public function registerTopHeaderNotification(?string $options): ?string
    {
        $cache = Cache::make(Application::class);

        if ($cache->has('unread-applications')) {
            $applications = $cache->get('unread-applications');
        } else {
            $applications = Application::query()
                ->where('status', ApplicationStatusEnum::NEW)
                ->select(['id', 'first_name', 'last_name', 'middle_name', 'email', 'phone', 'created_at'])->latest()
                ->paginate(10);

            $cache->put('unread-applications', $applications, 1);
        }

        if ($applications->total() == 0) {
            return $options;
        }

        return $options . view('plugins/applications::partials.notification', compact('applications'))->render();
    }

    public function getUnreadCount(string|null|int $number, string $menuId): int|string|null
    {
        if ($menuId !== 'cms-plugins-application') {
            return $number;
        }

        return view('core/base::partials.navbar.badge-count', ['class' => 'unread-applications'])->render();
    }

    public function getMenuItemCount(array $data = []): array
    {
        $cache = Cache::make(Application::class);

        if ($cache->has('unread-applications-count')) {
            $applicationCount = $cache->get('unread-applications-count');
        } else {
            $applicationCount = Application::query()->where('status', ApplicationStatusEnum::NEW)->count();

            $cache->put('unread-applications-count', $applicationCount, 1);
        }

        $data[] = [
            'key' => 'unread-applications',
            'value' => $applicationCount,
        ];

        return $data;
    }
}
