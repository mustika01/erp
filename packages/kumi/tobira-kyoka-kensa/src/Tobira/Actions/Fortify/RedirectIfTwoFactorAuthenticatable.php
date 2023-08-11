<?php

namespace Kumi\Tobira\Actions\Fortify;

use Laravel\Fortify\Events\TwoFactorAuthenticationChallenged;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable as BaseRedirectIfTwoFactorAuthenticatable;

class RedirectIfTwoFactorAuthenticatable extends BaseRedirectIfTwoFactorAuthenticatable
{
    /**
     * Get the two factor authentication enabled response.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function twoFactorChallengeResponse($request, $user)
    {
        $request->session()->put([
            'login.id' => $user->getKey(),
            'login.remember' => $request->filled('remember'),
        ]);

        TwoFactorAuthenticationChallenged::dispatch($user);

        return $request->wantsJson()
                    ? response()->json(['two_factor' => true])
                    : redirect()->route('filament.two-factor.create');
    }
}
