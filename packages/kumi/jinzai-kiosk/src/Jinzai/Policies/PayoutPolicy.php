<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Support\DefaultPermissions;

class PayoutPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_PAYOUT);
    }

    public function view(User $user, Payout $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_PAYOUT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_PAYOUTS);
    }

    public function update(User $user, Payout $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_PAYOUT);
    }

    public function delete(User $user, Payout $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_PAYOUT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_PAYOUTS);
    }
}
