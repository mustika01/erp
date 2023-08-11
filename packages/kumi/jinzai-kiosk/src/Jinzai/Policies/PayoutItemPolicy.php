<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\PayoutItem;
use Kumi\Jinzai\Support\DefaultPermissions;

class PayoutItemPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_PAYOUT_ITEM);
    }

    public function view(User $user, PayoutItem $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_PAYOUT_ITEM);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_PAYOUT_ITEMS);
    }

    public function update(User $user, PayoutItem $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_PAYOUT_ITEM);
    }

    public function delete(User $user, PayoutItem $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_PAYOUT_ITEM);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_PAYOUT_ITEMS);
    }
}
