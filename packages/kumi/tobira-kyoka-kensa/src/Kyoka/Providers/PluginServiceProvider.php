<?php

namespace Kumi\Kyoka\Providers;

use Spatie\LaravelPackageTools\Package;
use Kumi\Kyoka\Filament\Resources\RoleResource;
use Kumi\Kyoka\Filament\Resources\UserResource;
use Kumi\Kyoka\Console\Commands\BootstrapCommand;
use Kumi\Kyoka\Console\Commands\InitSystemUserCommand;
use Kumi\Kyoka\Console\Commands\MakeAdministratorCommand;
use Kumi\Kyoka\Console\Commands\MakeSuperAdministratorCommand;
use Filament\PluginServiceProvider as BasePluginServiceProvider;

class PluginServiceProvider extends BasePluginServiceProvider
{
    protected array $resources = [
        UserResource::class,
        RoleResource::class,
    ];

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('kyoka')
            ->hasCommands([
                BootstrapCommand::class,
                InitSystemUserCommand::class,
                MakeAdministratorCommand::class,
                MakeSuperAdministratorCommand::class,
            ])
        ;
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations/kyoka');
        $this->loadTranslationsFrom(__DIR__ . '/../../../lang/kyoka', 'kyoka');
    }
}
