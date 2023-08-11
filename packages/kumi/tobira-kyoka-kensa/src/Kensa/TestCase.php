<?php

namespace Kumi\Kensa;

use BladeUI\Heroicons\BladeHeroiconsServiceProvider;
use BladeUI\Icons\BladeIconsServiceProvider;
use Filament\FilamentServiceProvider;
use Filament\Forms\FormsServiceProvider;
use Filament\Notifications\NotificationsServiceProvider;
use Filament\Support\SupportServiceProvider;
use Filament\Tables\TablesServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Kumi\Jinzai\JinzaiServiceProvider;
use Kumi\Kanri\KanriServiceProvider;
use Kumi\Kanshi\KanshiServiceProvider;
use Kumi\Keiri\KeiriServiceProvider;
use Kumi\Kyoka\KyokaServiceProvider;
use Kumi\Sousa\SousaServiceProvider;
use Kumi\Tobira\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use Kumi\Tobira\Http\Middleware\EnsureAccountIsActivated;
use Kumi\Tobira\TobiraServiceProvider;
use Kumi\Zaimu\ZaimuServiceProvider;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Features;
use Laravel\Fortify\FortifyServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use RyanChandler\BladeCaptureDirective\BladeCaptureDirectiveServiceProvider;
use Spatie\Activitylog\ActivitylogServiceProvider;
use Spatie\LaravelSettings\LaravelSettingsServiceProvider;
use Spatie\MediaLibrary\MediaLibraryServiceProvider;
use Spatie\Permission\PermissionServiceProvider;
use STS\FilamentImpersonate\FilamentImpersonateServiceProvider;

/**
 * @internal
 */
abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('kyoka:bootstrap');
        $this->artisan('kyoka:init-system-user');
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('laravel-impersonate.session_key', 'impersonated_by');
        config()->set('fortify.features', [
            Features::registration(),
            Features::resetPasswords(),
            Features::emailVerification(),
            Features::updateProfileInformation(),
            Features::updatePasswords(),
            Features::twoFactorAuthentication([
                'confirm' => true,
                'confirmPassword' => true,
            ]),
        ]);
        config()->set('fortify.pipelines.login', [
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
            AttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]);
        config()->set('filament.middleware.auth', array_merge(config('filament.middleware.auth'), [
            EnsureAccountIsActivated::class,
        ]));
        // config()->set('activitylog.default_auth_driver', 'web');
        // config()->set('activitylog.default_log_name', 'default');
        // config()->set('activitylog.activity_model', Activity::class);
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            FilamentServiceProvider::class,
            FormsServiceProvider::class,
            TablesServiceProvider::class,
            NotificationsServiceProvider::class,
            SupportServiceProvider::class,
            BladeCaptureDirectiveServiceProvider::class,
            BladeIconsServiceProvider::class,
            BladeHeroiconsServiceProvider::class,
            FilamentImpersonateServiceProvider::class,
            MediaLibraryServiceProvider::class,
            FortifyServiceProvider::class,
            PermissionServiceProvider::class,
            TobiraServiceProvider::class,
            JinzaiServiceProvider::class,
            SousaServiceProvider::class,
            KanriServiceProvider::class,
            ZaimuServiceProvider::class,
            KeiriServiceProvider::class,
            KyokaServiceProvider::class,
            KanshiServiceProvider::class,
            ActivitylogServiceProvider::class,
            LaravelSettingsServiceProvider::class,
        ];
    }

    protected function defineDatabaseMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../../../../database/migrations');
    }
}
