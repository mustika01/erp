<?php

namespace Kumi\Kyoka\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Kyoka\Support\DefaultPermissions;

class UserPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_USER);
    }

    public function view(User $user, User $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_USER);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_USERS);
    }

    public function update(User $user, User $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_USER);
    }

    public function delete(User $user, User $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_USER);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_USERS);
    }
}
