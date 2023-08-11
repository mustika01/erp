<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Identity;
use Kumi\Jinzai\Support\DefaultPermissions;

class IdentityPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_IDENTITY);
    }

    public function view(User $user, Identity $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_IDENTITY);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_IDENTITIES);
    }

    public function update(User $user, Identity $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_IDENTITY);
    }

    public function delete(User $user, Identity $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_IDENTITY);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_IDENTITIES);
    }
}
