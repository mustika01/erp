<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Norikumi\Models\Bank;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class BankPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_BANK);
    }

    public function view(User $user, Bank $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_BANK);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_BANKS);
    }

    public function update(User $user, Bank $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_BANK);
    }

    public function delete(User $user, Bank $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_BANK);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_BANKS);
    }
}
