<?php

namespace Kumi\Kiosk\Providers;

use Spatie\LaravelPackageTools\Package;
use Kumi\Kiosk\Filament\Pages\MyInformation;
use Kumi\Kiosk\Filament\Resources\PersonalPayoutResource;
use Kumi\Kiosk\Filament\Resources\PersonalTicketResource;
use Kumi\Kiosk\Console\Commands\InitTicketCategoriesCommand;
use Filament\PluginServiceProvider as BasePluginServiceProvider;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $pages = [
        MyInformation::class,
    ];

    protected array $resources = [
        PersonalPayoutResource::class,
        PersonalTicketResource::class,
    ];

    protected array $widgets = [
        PersonalPayoutResource\Widgets\PayoutAmountWidget::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('kiosk')
            ->hasCommands([
                InitTicketCategoriesCommand::class,
            ])
        ;
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations/kiosk');
        $this->loadTranslationsFrom(__DIR__ . '/../../../lang/kiosk', 'kiosk');
        $this->loadViewsFrom(__DIR__ . '/../../../views/kiosk', 'kiosk');
    }
}
