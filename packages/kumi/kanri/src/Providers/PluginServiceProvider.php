<?php

namespace Kumi\Kanri\Providers;

use Spatie\LaravelPackageTools\Package;
use Kumi\Kanri\Filament\Resources\ReportResource;
use Kumi\Kanri\Filament\Resources\TicketResource;
use Filament\PluginServiceProvider as BasePluginServiceProvider;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $resources = [
        TicketResource::class,
        ReportResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('kanri');
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../views', 'kanri');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'kanri');
    }
}
