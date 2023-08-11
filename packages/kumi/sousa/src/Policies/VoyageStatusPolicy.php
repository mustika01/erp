<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VoyageStatus;
use Kumi\Sousa\Support\DefaultPermissions;

class VoyageStatusPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_VOYAGE_STATUS);
    }

    public function view(User $user, Vessel $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_VOYAGE_STATUS);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES);
    }

    public function update(User $user, VoyageStatus $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_VOYAGE_STATUS);
    }

    public function delete(User $user, VoyageStatus $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_VOYAGE_STATUS);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES);
    }
}
