<?php

namespace Kumi\Jinzai\Actions;

use Kumi\Jinzai\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Jinzai\Events\Employee\Onboarded;
use Kumi\Tobira\Events\User\PasswordUpdated;
use Illuminate\Contracts\Auth\Authenticatable;

class CompleteEmployeeOnboarding
{
    use AsAction;

    public function handle(Authenticatable $user, Employee $employee, array $data)
    {
        Auth::login($user);

        Onboarded::dispatch($employee);

        PasswordUpdated::dispatch($user, $data['password']);
    }
}
