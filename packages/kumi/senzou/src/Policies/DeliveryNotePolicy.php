<?php

namespace Kumi\Senzou\Policies;

use Kumi\Senzou\Models\DeliveryNote;
use Kumi\Senzou\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class DeliveryNotePolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_DELIVERY_NOTE);
    }

    public function view(User $user, DeliveryNote $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_DELIVERY_NOTE);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_DELIVERY_NOTES);
    }

    public function update(User $user, DeliveryNote $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_DELIVERY_NOTE);
    }

    public function delete(User $user, DeliveryNote $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_DELIVERY_NOTE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_DELIVERY_NOTES);
    }
}
