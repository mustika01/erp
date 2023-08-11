<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Support\DefaultPermissions;

class PayrollPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_PAYROLL);
    }

    public function view(User $user, Payroll $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_PAYROLL);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_PAYROLLS);
    }

    public function update(User $user, Payroll $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_PAYROLL);
    }

    public function delete(User $user, Payroll $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_PAYROLL);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_PAYROLLS);
    }
}
