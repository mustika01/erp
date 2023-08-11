<?php

namespace Kumi\Kanri\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Kanri\Models\Report;
use Kumi\Kanri\Support\DefaultPermissions;

class ReportPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_PAYOUT_REPORT)
            || $user->can(DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT);
    }

    public function view(User $user, Report $model): bool
    {
        if ($user->can(DefaultPermissions::VIEW_REPORT)) {
            return true;
        }

        return match ($model->reportable_type) {
            \Kumi\Jinzai\Models\Payout::class => $user->can(DefaultPermissions::VIEW_PAYOUT_REPORT),
            'docking-schedule' => $user->can(DefaultPermissions::VIEW_DOCKING_SCHEDULE_REPORT),
            default => false,
        };
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_REPORTS)
            || $user->can(DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS)
            || $user->can(DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS);
    }

    public function update(User $user, Report $model): bool
    {
        return false;
    }

    public function delete(User $user, Report $model): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
