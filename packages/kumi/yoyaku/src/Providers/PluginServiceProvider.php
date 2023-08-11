<?php

namespace Kumi\Yoyaku\Providers;

use Spatie\LaravelPackageTools\Package;
use Kumi\Yoyaku\Filament\Pages\BookableCalendar;
use Kumi\Yoyaku\Filament\Resources\BookableResource;
use Kumi\Yoyaku\Filament\Widgets\BookableCalendarWidget;
use Filament\PluginServiceProvider as BasePluginServiceProvider;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $pages = [
        BookableCalendar::class,
    ];

    protected array $resources = [
        BookableResource::class,
    ];

    protected array $widgets = [
        BookableCalendarWidget::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('yoyaku');
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'yoyaku');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'yoyaku');
    }
}
