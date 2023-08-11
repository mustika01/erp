<?php

namespace Kumi\Tobira\Filament\Pages\TwoFactorAuthentication;

use Filament\Pages\Page;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kumi\Tobira\Support\DefaultPermissions;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;
use Kumi\Tobira\Actions\TwoFactorAuthentication\GenerateRecoveryCodes;
use Kumi\Tobira\Actions\TwoFactorAuthentication\EnableTwoFactorAuthentication;

class RecoveryCode extends Page
{
    protected static ?string $navigationGroup = 'tobira';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Two Factor Authentication';

    protected static ?int $navigationSort = 8004;

    protected static ?string $slug = 'tobira/two-factor-authentication/recovery-code';

    protected static ?string $title = 'Two Factor Authentication';

    protected static string $view = 'tobira::filament.pages.two-factor-authentication.recovery-code';

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

    public function mount(): void
    {
        $hasConfirmedOTPCode = Session::has(TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED);

        if (! $hasConfirmedOTPCode) {
            $this->redirectRoute('filament.pages.tobira/two-factor-authentication/qr-code');
        }
    }

    public function handle(): void
    {
        EnableTwoFactorAuthentication::run();

        Session::forget([
            TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED,
            TwoFactorAuthentication::ONE_TIME_PASSWORD_SECRET,
            TwoFactorAuthentication::RECOVERY_CODES,
        ]);

        $this->redirectRoute('filament.pages.tobira/two-factor-authentication/status');
    }

    protected function getViewData(): array
    {
        return [
            'codes' => GenerateRecoveryCodes::run(),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::MANAGE_TWO_FACTOR_AUTHENTICATION)
            && Session::has(TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED);
    }
}
