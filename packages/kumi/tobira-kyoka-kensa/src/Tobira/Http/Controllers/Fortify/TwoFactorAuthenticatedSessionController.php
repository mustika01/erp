<?php

namespace Kumi\Tobira\Http\Controllers\Fortify;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Auth\StatefulGuard;
use Laravel\Fortify\Events\RecoveryCodeReplaced;
use Illuminate\Http\Exceptions\HttpResponseException;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;
use Laravel\Fortify\Http\Requests\TwoFactorLoginRequest;
use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse;
use Kumi\Tobira\Support\Contracts\FailedTwoFactorLoginResponse;

class TwoFactorAuthenticatedSessionController extends Controller
{
    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    /**
     * Show the two factor authentication challenge view.
     */
    public function create(TwoFactorLoginRequest $request): TwoFactorChallengeViewResponse
    {
        if (! $request->hasChallengedUser()) {
            throw new HttpResponseException(redirect()->route('filament.session.create'));
        }

        return app(TwoFactorChallengeViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session using the two factor authentication code.
     *
     * @return mixed
     */
    public function store(TwoFactorLoginRequest $request)
    {
        $user = $request->challengedUser();

        if ($code = $request->validRecoveryCode()) {
            $user->replaceRecoveryCode($code);

            event(new RecoveryCodeReplaced($user, $code));
        } elseif (! $request->hasValidCode()) {
            return app(FailedTwoFactorLoginResponse::class);
        }

        $this->guard->login($user, $request->remember());

        $request->session()->regenerate();

        return app(TwoFactorLoginResponse::class);
    }
}
