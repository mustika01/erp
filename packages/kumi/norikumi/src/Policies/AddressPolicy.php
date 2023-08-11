<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Norikumi\Models\Address;
use Kumi\Norikumi\Support\DefaultPermissions;

class AddressPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_ADDRESS);
    }

    public function view(User $user, Address $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_ADDRESS);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_ADDRESSES);
    }

    public function update(User $user, Address $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_ADDRESS);
    }

    public function delete(User $user, Address $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_ADDRESS);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_ADDRESSES);
    }
}
