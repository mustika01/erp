<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\CargoLog;
use Kumi\Sousa\Support\DefaultPermissions;

class CargoLogPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_CARGO_LOG);
    }

    public function view(User $user, CargoLog $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_CARGO_LOG);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_CARGO_LOGS);
    }

    public function update(User $user, CargoLog $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_CARGO_LOG);
    }

    public function delete(User $user, CargoLog $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_CARGO_LOG);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_CARGO_LOGS);
    }
}
