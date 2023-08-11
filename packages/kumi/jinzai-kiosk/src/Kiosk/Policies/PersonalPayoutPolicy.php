<?php

namespace Kumi\Kiosk\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Kiosk\Models\PersonalPayout;
use Kumi\Kiosk\Support\DefaultPermissions;

class PersonalPayoutPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_PERSONAL_PAYOUT);
    }

    public function view(User $user, PersonalPayout $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_PERSONAL_PAYOUT)
            && $model->payroll->employee->user->is($user);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_PERSONAL_PAYOUTS);
    }

    public function update(User $user, PersonalPayout $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_PERSONAL_PAYOUT)
            && $model->payroll->employee->user->is($user)
            && $model->isPending();
    }

    public function delete(User $user, PersonalPayout $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_PERSONAL_PAYOUT)
            && $model->payroll->employee->user->is($user);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_PERSONAL_PAYOUTS);
    }
}
