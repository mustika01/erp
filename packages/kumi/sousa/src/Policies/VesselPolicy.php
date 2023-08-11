<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Support\DefaultPermissions;

class VesselPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_VESSEL);
    }

    public function view(User $user, Vessel $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_VESSEL);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_VESSELS);
    }

    public function update(User $user, Vessel $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_VESSEL);
    }

    public function delete(User $user, Vessel $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_VESSEL);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_VESSELS);
    }
}
