<?php

use Laravel\Fortify\Features;
use Illuminate\Support\Facades\Route;
use Kumi\Tobira\Http\Controllers\LoginController;
use Laravel\Fortify\Http\Controllers\PasswordController;
use Laravel\Fortify\Http\Controllers\RecoveryCodeController;
use Kumi\Tobira\Http\Controllers\Fortify\NewPasswordController;
use Kumi\Tobira\Http\Controllers\Fortify\VerifyEmailController;
use Laravel\Fortify\Http\Controllers\TwoFactorQrCodeController;
use Kumi\Tobira\Http\Controllers\Fortify\RegisteredUserController;
use Laravel\Fortify\Http\Controllers\ProfileInformationController;
use Laravel\Fortify\Http\Controllers\TwoFactorSecretKeyController;
use Kumi\Tobira\Http\Controllers\Fortify\PasswordResetLinkController;
use Kumi\Tobira\Http\Controllers\Fortify\ConfirmablePasswordController;
use Laravel\Fortify\Http\Controllers\ConfirmedPasswordStatusController;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticationController;
use Kumi\Tobira\Http\Controllers\Fortify\AuthenticatedSessionController;
use Kumi\Tobira\Http\Controllers\Fortify\AccountActivationPromptController;
use Kumi\Tobira\Http\Controllers\Fortify\EmailVerificationPromptController;
use Laravel\Fortify\Http\Controllers\ConfirmedTwoFactorAuthenticationController;
use Kumi\Tobira\Http\Controllers\Fortify\EmailVerificationNotificationController;
use Kumi\Tobira\Http\Controllers\Fortify\TwoFactorAuthenticatedSessionController;

Route::domain(config('filament.domain'))
    ->middleware(config('filament.middleware.base'))
    ->name('filament.')
    ->group(function () {
        Route::prefix(config('filament.path'))->group(function () {
            $enableViews = config('fortify.views', true);

            // Authentication...
            if ($enableViews) {
                Route::get('/session/create', [AuthenticatedSessionController::class, 'create'])
                    ->middleware(['guest:' . config('fortify.guard')])
                    ->name('session.create')
                ;
            }

            $limiter = config('fortify.limiters.login');
            $twoFactorLimiter = config('fortify.limiters.two-factor');
            $verificationLimiter = config('fortify.limiters.verification', '6,1');

            Route::post('/session', [AuthenticatedSessionController::class, 'store'])
                ->middleware(array_filter([
                    'guest:' . config('fortify.guard'),
                    $limiter ? 'throttle:' . $limiter : null,
                ]))
                ->name('session.store')
            ;

            Route::delete('/session', [AuthenticatedSessionController::class, 'destroy'])
                ->name('session.destroy')
            ;

            // Password Reset...
            if (Features::enabled(Features::resetPasswords())) {
                if ($enableViews) {
                    Route::get('/password-reset-link', [PasswordResetLinkController::class, 'create'])
                        ->middleware(['guest:' . config('fortify.guard')])
                        ->name('password-reset-link.create')
                    ;

                    Route::get('/new-password/{token}', [NewPasswordController::class, 'edit'])
                        ->middleware(['guest:' . config('fortify.guard')])
                        ->name('new-password.edit')
                    ;
                }

                Route::post('/password-reset-link', [PasswordResetLinkController::class, 'store'])
                    ->middleware(['guest:' . config('fortify.guard')])
                    ->name('password-reset-link.store')
                ;

                Route::put('/new-password', [NewPasswordController::class, 'update'])
                    ->middleware(['guest:' . config('fortify.guard')])
                    ->name('new-password.update')
                ;
            }

            // Registration...
            if (Features::enabled(Features::registration())) {
                if ($enableViews) {
                    Route::get('/registration/create', [RegisteredUserController::class, 'create'])
                        ->middleware(['guest:' . config('fortify.guard')])
                        ->name('registration.create')
                    ;
                }

                Route::post('/registration', [RegisteredUserController::class, 'store'])
                    ->middleware(['guest:' . config('fortify.guard')])
                    ->name('registration.store')
                ;
            }

            // Email Verification...
            if (Features::enabled(Features::emailVerification())) {
                if ($enableViews) {
                    Route::get('/email/verify', [EmailVerificationPromptController::class, '__invoke'])
                        ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                        ->name('email-verification.prompt')
                    ;
                }

                Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'signed', 'throttle:' . $verificationLimiter])
                    ->name('email-verification.verify')
                ;

                Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'throttle:' . $verificationLimiter])
                    ->name('email-verification.send')
                ;
            }

            // Profile Information...
            // if (Features::enabled(Features::updateProfileInformation())) {
            //     Route::put('/user/profile-information', [ProfileInformationController::class, 'update'])
            //         ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            //         ->name('user-profile-information.update')
            //     ;
            // }
            // Kumi\Tobira\Filament\Pages\Profile::class

            // Passwords...
            // if (Features::enabled(Features::updatePasswords())) {
            //     Route::put('/user/password', [PasswordController::class, 'update'])
            //         ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            //         ->name('user-password.update')
            //     ;
            // }
            // Kumi\Tobira\Filament\Pages\Password::class

            // Password Confirmation...
            if ($enableViews) {
                Route::get('/user/confirm-password', [ConfirmablePasswordController::class, 'show'])
                    ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                    ->name('confirm-password.show')
                ;
            }

            // Route::get('/user/confirmed-password-status', [ConfirmedPasswordStatusController::class, 'show'])
            //     ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
            //     ->name('password.confirmation')
            // ;

            Route::post('/user/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                ->name('confirm-password.store')
            ;

            // Two Factor Authentication...
            if (Features::enabled(Features::twoFactorAuthentication())) {
                if ($enableViews) {
                    Route::get('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'create'])
                        ->middleware(['guest:' . config('fortify.guard')])
                        ->name('two-factor.create')
                    ;
                }

                Route::post('/two-factor-challenge', [TwoFactorAuthenticatedSessionController::class, 'store'])
                    ->middleware(array_filter([
                        'guest:' . config('fortify.guard'),
                        $twoFactorLimiter ? 'throttle:' . $twoFactorLimiter : null,
                    ]))
                    ->name('two-factor.store')
                ;

                // $twoFactorMiddleware = Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword')
                //     ? [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard'), 'password.confirm']
                //     : [config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')];

                // Route::post('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'store'])
                //     ->middleware($twoFactorMiddleware)
                //     ->name('two-factor.enable')
                // ;

                // Route::post('/user/confirmed-two-factor-authentication', [ConfirmedTwoFactorAuthenticationController::class, 'store'])
                //     ->middleware($twoFactorMiddleware)
                //     ->name('two-factor.confirm')
                // ;

                // Route::delete('/user/two-factor-authentication', [TwoFactorAuthenticationController::class, 'destroy'])
                //     ->middleware($twoFactorMiddleware)
                //     ->name('two-factor.disable')
                // ;

                // Route::get('/user/two-factor-qr-code', [TwoFactorQrCodeController::class, 'show'])
                //     ->middleware($twoFactorMiddleware)
                //     ->name('two-factor.qr-code')
                // ;

                // Route::get('/user/two-factor-secret-key', [TwoFactorSecretKeyController::class, 'show'])
                //     ->middleware($twoFactorMiddleware)
                //     ->name('two-factor.secret-key')
                // ;

                // Route::get('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'index'])
                //     ->middleware($twoFactorMiddleware)
                //     ->name('two-factor.recovery-codes')
                // ;

                // Route::post('/user/two-factor-recovery-codes', [RecoveryCodeController::class, 'store'])
                //     ->middleware($twoFactorMiddleware)
                // ;
            }

            // Activation...
            Route::get('/account/activate', [AccountActivationPromptController::class, '__invoke'])
                ->middleware([config('fortify.auth_middleware', 'auth') . ':' . config('fortify.guard')])
                ->name('account-activation.prompt')
            ;

            Route::get('/login', LoginController::class)->name('auth.login');
        });
    })
;

Route::get('/login', LoginController::class)->name('login');
