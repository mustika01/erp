<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Support\DefaultPermissions;

class BunkerPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_BUNKER);
    }

    public function view(User $user, Bunker $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_BUNKER);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_BUNKERS);
    }

    public function update(User $user, Bunker $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_BUNKER);
    }

    public function delete(User $user, Bunker $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_BUNKER);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_BUNKERS);
    }
}
