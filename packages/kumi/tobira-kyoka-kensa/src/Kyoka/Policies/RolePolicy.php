<?php

namespace Kumi\Kyoka\Policies;

use Kumi\Kyoka\Models\Role;
use Kumi\Tobira\Models\User;
use Kumi\Kyoka\Support\DefaultPermissions;

class RolePolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_ROLE);
    }

    public function view(User $user, Role $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_ROLE);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_ROLES);
    }

    public function update(User $user, Role $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_ROLE);
    }

    public function delete(User $user, Role $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_ROLE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_ROLES);
    }
}
