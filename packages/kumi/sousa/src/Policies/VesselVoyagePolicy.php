<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Support\DefaultPermissions;

class VesselVoyagePolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_VESSEL_VOYAGE);
    }

    public function view(User $user, VesselVoyage $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_VESSEL_VOYAGE);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES);
    }

    public function update(User $user, VesselVoyage $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_VESSEL_VOYAGE);
    }

    public function delete(User $user, VesselVoyage $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_VESSEL_VOYAGE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES);
    }
}
