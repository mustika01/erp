<?php

namespace Kumi\Kanshi\Providers;

use Spatie\LaravelPackageTools\Package;
use Kumi\Kanshi\Filament\Resources\ActivityResource;
use Filament\PluginServiceProvider as BasePluginServiceProvider;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $resources = [
        ActivityResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('kanshi');
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'kanshi');
    }
}
