<?php

namespace Kumi\Tobira\Actions\TwoFactorAuthentication;

use Kumi\Tobira\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;
use Illuminate\Contracts\Auth\StatefulGuard;

class DisableTwoFactorAuthentication
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
            'two_factor_confirmed_at' => null,
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
        ]);

        $this->user->save();
    }
}
