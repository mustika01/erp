<?php

namespace Kumi\Kiosk\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Kiosk\Models\PersonalPayoutItem;
use Kumi\Kiosk\Support\DefaultPermissions;

class PersonalPayoutItemPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_PERSONAL_PAYOUT_ITEM);
    }

    public function view(User $user, PersonalPayoutItem $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_PERSONAL_PAYOUT_ITEM);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_PERSONAL_PAYOUT_ITEMS);
    }

    public function update(User $user, PersonalPayoutItem $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_PERSONAL_PAYOUT_ITEM);
    }

    public function delete(User $user, PersonalPayoutItem $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_PERSONAL_PAYOUT_ITEM);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_PERSONAL_PAYOUT_ITEMS);
    }
}
