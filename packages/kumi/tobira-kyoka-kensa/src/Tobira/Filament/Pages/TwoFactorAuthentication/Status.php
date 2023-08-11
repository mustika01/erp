<?php

namespace Kumi\Tobira\Filament\Pages\TwoFactorAuthentication;

use Filament\Pages\Page;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kumi\Tobira\Support\DefaultPermissions;
use Illuminate\Contracts\Auth\StatefulGuard;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;
use Kumi\Tobira\Actions\TwoFactorAuthentication\GenerateRecoveryCodes;
use Kumi\Tobira\Actions\TwoFactorAuthentication\DisableTwoFactorAuthentication;

class Status extends Page
{
    public $isShowingRecoveryCodes = false;

    protected static ?string $navigationGroup = 'tobira';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Two Factor Authentication';

    protected static ?int $navigationSort = 8005;

    protected static ?string $slug = 'tobira/two-factor-authentication/status';

    protected static ?string $title = 'Two Factor Authentication';

    protected static string $view = 'tobira::filament.pages.two-factor-authentication.status';

    public static function getMiddlewares(): string|array
    {
        $middlewares = [
            'can:' . DefaultPermissions::MANAGE_TWO_FACTOR_AUTHENTICATION,
        ];

        if (Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')) {
            $middlewares[] = 'password.confirm:filament.confirm-password.show';
        }

        return $middlewares;
    }

    public function mount(StatefulGuard $guard): void
    {
        if (! $guard->user()->hasEnabledTwoFactorAuthentication()) {
            $this->redirectRoute('filament.pages.tobira/two-factor-authentication/qr-code');
        }
    }

    public function disable(): void
    {
        DisableTwoFactorAuthentication::run();

        $this->redirectRoute('filament.pages.tobira/two-factor-authentication/qr-code');
    }

    public function generate(StatefulGuard $guard): void
    {
        $guard->user()->forceFill([
            'two_factor_recovery_codes' => encrypt(GenerateRecoveryCodes::run(true)),
        ])->save();

        Session::forget(TwoFactorAuthentication::RECOVERY_CODES);
    }

    protected function getViewData(): array
    {
        return [
            'codes' => Auth::user()->recoveryCodes(),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::MANAGE_TWO_FACTOR_AUTHENTICATION)
            && Auth::user()->hasEnabledTwoFactorAuthentication();
    }
}
