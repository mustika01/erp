<?php

namespace Kumi\Tobira\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Kumi\Tobira\Http\Livewire\Forms\LoginForm;
use Kumi\Tobira\Http\Livewire\Forms\RegistrationForm;
use Kumi\Tobira\Http\Livewire\Forms\ResetPasswordForm;
use Kumi\Tobira\Http\Livewire\Forms\ForgotPasswordForm;
use Kumi\Tobira\Http\Livewire\Forms\ConfirmPasswordForm;
use Kumi\Tobira\Http\Livewire\Forms\TwoFactorChallengeForm;

class LivewireServiceProvider extends ServiceProvider
{
    protected array $components = [
        'tobira::forms.login' => LoginForm::class,
        'tobira::forms.two-factor-challenge' => TwoFactorChallengeForm::class,
        'tobira::forms.forgot-password' => ForgotPasswordForm::class,
        'tobira::forms.registration' => RegistrationForm::class,
        'tobira::forms.reset-password' => ResetPasswordForm::class,
        'tobira::forms.confirm-password' => ConfirmPasswordForm::class,
    ];

    public function boot()
    {
        foreach ($this->components as $key => $value) {
            Livewire::component($key, $value);
        }
    }
}
