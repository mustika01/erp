<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\BunkerFormula;
use Kumi\Sousa\Support\DefaultPermissions;

class BunkerFormulaPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_BUNKER_FORMULA);
    }

    public function view(User $user, BunkerFormula $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_BUNKER_FORMULA);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS);
    }

    public function update(User $user, BunkerFormula $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_BUNKER_FORMULA);
    }

    public function delete(User $user, BunkerFormula $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_BUNKER_FORMULA);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS);
    }
}
