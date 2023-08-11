<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Jinzai\Models\Bank;
use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Support\DefaultPermissions;

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
