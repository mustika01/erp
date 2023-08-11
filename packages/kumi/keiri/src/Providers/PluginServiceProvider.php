<?php

namespace Kumi\Keiri\Providers;

use Spatie\LaravelPackageTools\Package;
use Filament\PluginServiceProvider as BasePluginServiceProvider;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $resources = [
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('keiri');
    }

    public function bootingPackage(): void
    {
        // $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        // $this->loadViewsFrom(__DIR__ . '/../../views', 'zaimu');
        // $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'zaimu');
    }
}
