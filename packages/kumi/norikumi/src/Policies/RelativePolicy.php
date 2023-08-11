<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Norikumi\Models\Relative;
use Kumi\Norikumi\Support\DefaultPermissions;

class RelativePolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_RELATIVE);
    }

    public function view(User $user, Relative $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_RELATIVE);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_RELATIVES);
    }

    public function update(User $user, Relative $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_RELATIVE);
    }

    public function delete(User $user, Relative $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_RELATIVE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_RELATIVES);
    }
}
