<?php

namespace Kumi\Senzou\Policies;

use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class ItemPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_ITEM);
    }

    public function view(User $user, Item $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_ITEM);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_ITEMS);
    }

    public function update(User $user, Item $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_ITEM);
    }

    public function delete(User $user, Item $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_ITEM);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_ITEMS);
    }
}
