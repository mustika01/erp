<?php

namespace Kumi\Senzou\Policies;

use Kumi\Senzou\Models\VesselUser;
use Kumi\Senzou\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class VesselUserPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_VESSEL_USER);
    }

    public function view(User $user, VesselUser $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_VESSEL_USER);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_VESSEL_USERS);
    }

    public function update(User $user, VesselUser $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_VESSEL_USER);
    }

    public function delete(User $user, VesselUser $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_VESSEL_USER);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_VESSEL_USERS);
    }
}
