<?php

namespace Kumi\Tobira\Filament\Pages\TwoFactorAuthentication;

use Filament\Forms;
use Filament\Pages\Page;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Kumi\Tobira\Validation\Rules\OTPCode;
use Kumi\Tobira\Support\DefaultPermissions;
use Illuminate\Contracts\Auth\StatefulGuard;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;
use Kumi\Tobira\Actions\TwoFactorAuthentication\GenerateQRCode;

class QRCode extends Page
{
    public string $otp = '';

    protected static ?string $navigationGroup = 'tobira';

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Two Factor Authentication';

    protected static ?int $navigationSort = 8003;

    protected static ?string $slug = 'tobira/two-factor-authentication/qr-code';

    protected static ?string $title = 'Two Factor Authentication';

    protected static string $view = 'tobira::filament.pages.two-factor-authentication.qr-code';

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
        if ($guard->user()->hasEnabledTwoFactorAuthentication()) {
            $this->redirectRoute('filament.pages.tobira/two-factor-authentication/status');
        }
    }

    public function handle(): void
    {
        $this->validate();

        session([TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED => true]);

        $this->redirectRoute('filament.pages.tobira/two-factor-authentication/recovery-code');
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('otp')
                ->label(__('tobira::two-factor-authentication/qr-code.fields.otp.label'))
                ->rules(['required', 'numeric', 'digits:6', app(OTPCode::class)])
                ->validationAttribute('OTP Code')
                ->required()
                ->autofocus()
                ->extraInputAttributes(['class' => 'md:w-32']),
        ];
    }

    protected function getViewData(): array
    {
        return [
            'qr' => GenerateQRCode::run(),
        ];
    }

    /**
     * @codeCoverageIgnore
     */
    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::MANAGE_TWO_FACTOR_AUTHENTICATION)
            && ! Session::has(TwoFactorAuthentication::ONE_TIME_PASSWORD_CONFIRMED)
            && ! Auth::user()->hasEnabledTwoFactorAuthentication();
    }
}
