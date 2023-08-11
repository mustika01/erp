<?php

namespace Kumi\Tobira\Actions;

use Illuminate\Support\Str;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Tobira\Events\User\PasswordUpdated;
use Illuminate\Contracts\Auth\Authenticatable;

class CompletePasswordUpdate
{
    use AsAction;

    public function handle(Authenticatable $user, array $data): void
    {
        $user->setRememberToken(Str::random(60));

        PasswordUpdated::dispatch($user, $data['password']);
    }
}
