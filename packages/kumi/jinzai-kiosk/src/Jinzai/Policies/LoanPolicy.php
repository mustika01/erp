<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Jinzai\Models\Loan;
use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Support\DefaultPermissions;

class LoanPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_LOAN);
    }

    public function view(User $user, Loan $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_LOAN);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_LOANS);
    }

    public function update(User $user, Loan $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_LOAN);
    }

    public function delete(User $user, Loan $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_LOAN);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_LOANS);
    }
}
