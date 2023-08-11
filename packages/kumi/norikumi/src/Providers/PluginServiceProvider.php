<?php

namespace Kumi\Norikumi\Providers;

use Filament\PluginServiceProvider as BasePluginServiceProvider;
use Kumi\Norikumi\Filament\Pages\ListVesselAssignments;
use Kumi\Norikumi\Filament\Pages\ListVessels;
use Kumi\Norikumi\Filament\Resources\CrewResource;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Filament\Resources\PayoutResource\Widgets\PayoutAmountWidget;
use Kumi\Norikumi\Filament\Resources\PayoutResource\Widgets\PayoutOverviewWidget;
use Kumi\Norikumi\Filament\Resources\PayrollResource;
use Kumi\Norikumi\Filament\Resources\RegistrationFormEntryResource;
use Spatie\LaravelPackageTools\Package;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $pages = [
        ListVessels::class,
        ListVesselAssignments::class,
    ];

    protected array $resources = [
        CrewResource::class,
        PayrollResource::class,
        PayoutResource::class,
        RegistrationFormEntryResource::class,
    ];

    protected array $widgets = [
        PayoutAmountWidget::class,
        PayoutOverviewWidget::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('norikumi');
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        $this->loadTranslationsFrom(__DIR__ . '/../../lang', 'norikumi');
        $this->loadViewsFrom(__DIR__ . '/../../views', 'norikumi');
    }
}
