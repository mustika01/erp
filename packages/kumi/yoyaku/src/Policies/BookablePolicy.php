<?php

namespace Kumi\Yoyaku\Policies;

use Kumi\Yoyaku\Models\Bookable;
use Illuminate\Foundation\Auth\User;
use Kumi\Yoyaku\Support\DefaultPermissions;

class BookablePolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_BOOKABLE);
    }

    public function view(User $user, Bookable $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_BOOKABLE);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_BOOKABLES);
    }

    public function update(User $user, Bookable $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_BOOKABLE);
    }

    public function delete(User $user, Bookable $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_BOOKABLE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_BOOKABLES);
    }
}
