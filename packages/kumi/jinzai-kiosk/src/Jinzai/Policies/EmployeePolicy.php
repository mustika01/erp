<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Support\DefaultPermissions;

class EmployeePolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_EMPLOYEE);
    }

    public function view(User $user, Employee $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_EMPLOYEE);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_EMPLOYEES);
    }

    public function update(User $user, Employee $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_EMPLOYEE);
    }

    public function delete(User $user, Employee $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_EMPLOYEE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_EMPLOYEES);
    }
}
