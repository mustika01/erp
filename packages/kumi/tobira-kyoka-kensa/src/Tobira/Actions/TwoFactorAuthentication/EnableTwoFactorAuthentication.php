<?php

namespace Kumi\Tobira\Actions\TwoFactorAuthentication;

use Kumi\Tobira\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Contracts\Auth\StatefulGuard;

class EnableTwoFactorAuthentication
{
    use AsAction;

    protected User $user;

    public function __construct(StatefulGuard $guard)
    {
        $this->user = $guard->user();
    }

    public function handle(): void
    {
        $this->user->forceFill([
            'two_factor_confirmed_at' => now(),
            'two_factor_secret' => encrypt(GenerateSecret::run()),
            'two_factor_recovery_codes' => encrypt(GenerateRecoveryCodes::run(true)),
        ]);

        $this->user->save();
    }
}
