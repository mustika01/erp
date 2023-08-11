<?php

namespace Kumi\Tobira\Providers;

use Laravel\Fortify\Features;
use Kumi\Tobira\Filament\Pages;
use Spatie\LaravelPackageTools\Package;
use Filament\PluginServiceProvider as BasePluginServiceProvider;

class PluginServiceProvider extends BasePluginServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package->name('tobira');
    }

    public function bootingPackage(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../database/migrations/tobira');
        $this->loadRoutesFrom(__DIR__ . '/../../../routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/../../../views', 'tobira');
        $this->loadTranslationsFrom(__DIR__ . '/../../../lang/tobira', 'tobira');
    }

    protected function getPages(): array
    {
        if (Features::enabled(Features::updateProfileInformation())) {
            $this->pages[] = Pages\Profile::class;
        }

        if (Features::enabled(Features::updatePasswords())) {
            $this->pages[] = Pages\Password::class;
        }

        if (Features::enabled(Features::twoFactorAuthentication())) {
            $this->pages[] = Pages\TwoFactorAuthentication\QRCode::class;
            $this->pages[] = Pages\TwoFactorAuthentication\RecoveryCode::class;
            $this->pages[] = Pages\TwoFactorAuthentication\Status::class;
        }

        return $this->pages;
    }
}
