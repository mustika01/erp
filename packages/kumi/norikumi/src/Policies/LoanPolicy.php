<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Norikumi\Models\Loan;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

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
