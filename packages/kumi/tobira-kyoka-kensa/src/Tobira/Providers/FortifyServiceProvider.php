<?php

namespace Kumi\Tobira\Providers;

use Illuminate\Http\Request;
use Kumi\Tobira\Models\User;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Features;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Auth\Notifications\VerifyEmail;
use Kumi\Tobira\Actions\Fortify\CreateNewUser;
use Illuminate\Auth\Notifications\ResetPassword;
use Kumi\Tobira\Actions\Fortify\ResetUserPassword;
use Laravel\Fortify\Actions\AttemptToAuthenticate;
use Kumi\Tobira\Actions\Fortify\UpdateUserPassword;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Kumi\Tobira\Http\Responses\FailedTwoFactorLoginResponse;
use Kumi\Tobira\Actions\Fortify\UpdateUserProfileInformation;
use Kumi\Tobira\Actions\Fortify\RedirectIfTwoFactorAuthenticatable;
use Kumi\Tobira\Support\Contracts\FailedTwoFactorLoginResponse as FailedTwoFactorLoginResponseContract;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        config(['auth.providers.users.model' => User::class]);

        Fortify::ignoreRoutes();

        $this->registerLoginPipelines();
        $this->registerResponseBindings();
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email . $request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        $this->configureViews();
        $this->configureResetPasswordUrlCallback();
        $this->configureVerificationUrlCallback();
    }

    protected function registerLoginPipelines()
    {
        config([
            'fortify.pipelines.login' => [
                config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
                Features::enabled(Features::twoFactorAuthentication()) ? RedirectIfTwoFactorAuthenticatable::class : null,
                AttemptToAuthenticate::class,
                PrepareAuthenticatedSession::class,
            ],
        ]);
    }

    protected function registerResponseBindings(): void
    {
        $this->app->singleton(FailedTwoFactorLoginResponseContract::class, FailedTwoFactorLoginResponse::class);
    }

    protected function configureViews(): void
    {
        Fortify::loginView('tobira::session.create');
        Fortify::requestPasswordResetLinkView('tobira::password-reset-link.create');
        Fortify::resetPasswordView(function ($request) {
            return view('tobira::new-password.edit', ['request' => $request]);
        });
        Fortify::registerView('tobira::registration.create');
        Fortify::verifyEmailView('tobira::email-verification.prompt');
        Fortify::confirmPasswordView('tobira::confirm-password.show');
        Fortify::twoFactorChallengeView('tobira::two-factor.create');
    }

    protected function configureResetPasswordUrlCallback(): void
    {
        ResetPassword::createUrlUsing(function ($notifiable, $token) {
            return URL::route('filament.new-password.edit', [
                'token' => $token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], true);
        });
    }

    protected function configureVerificationUrlCallback(): void
    {
        VerifyEmail::createUrlUsing(function ($notifiable) {
            return URL::temporarySignedRoute(
                'filament.email-verification.verify',
                now()->addMinutes(config('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );
        });
    }
}
