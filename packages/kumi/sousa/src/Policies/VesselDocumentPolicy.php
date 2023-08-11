<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\VesselDocument;
use Kumi\Sousa\Support\DefaultPermissions;

class VesselDocumentPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_VESSEL_DOCUMENT);
    }

    public function view(User $user, VesselDocument $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_VESSEL_DOCUMENT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS);
    }

    public function update(User $user, VesselDocument $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_VESSEL_DOCUMENT);
    }

    public function delete(User $user, VesselDocument $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_VESSEL_DOCUMENT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS);
    }
}
