<?php

namespace Kumi\Senzou\Providers;

use Filament\PluginServiceProvider as BasePluginServiceProvider;
use Kumi\Senzou\Filament\Pages\DeliveryNoteDailyReport;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource;
use Kumi\Senzou\Filament\Resources\ItemResource;
use Kumi\Senzou\Filament\Resources\RequestNoteResource;
use Kumi\Senzou\Filament\Resources\VesselUserResource;
use Spatie\LaravelPackageTools\Package;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $resources = [
        ItemResource::class,
        DeliveryNoteResource::class,
        VesselUserResource::class,
        RequestNoteResource::class,
    ];

    protected array $pages = [
        DeliveryNoteDailyReport::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('senzou');
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadViewsFrom(__DIR__ . '/../../views', 'senzou');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'senzou');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
    }
}
