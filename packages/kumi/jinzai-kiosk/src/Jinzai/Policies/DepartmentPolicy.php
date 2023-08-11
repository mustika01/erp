<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Support\DefaultPermissions;

class DepartmentPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_DEPARTMENT);
    }

    public function view(User $user, Department $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_DEPARTMENT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_DEPARTMENTS);
    }

    public function update(User $user, Department $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_DEPARTMENT);
    }

    public function delete(User $user, Department $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_DEPARTMENT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_DEPARTMENTS);
    }
}
