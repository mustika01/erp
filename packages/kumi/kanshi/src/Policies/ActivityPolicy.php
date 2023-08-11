<?php

namespace Kumi\Kanshi\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kanshi\Support\DefaultPermissions;

class ActivityPolicy
{
    /**
     * @codeCoverageIgnore
     */
    public function create(User $user): bool
    {
        return false;
    }

    public function view(User $user, Activity $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_ACTIVITY);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_ACTIVITIES);
    }

    /**
     * @codeCoverageIgnore
     */
    public function update(User $user, Activity $model): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function delete(User $user, Activity $model): bool
    {
        return false;
    }

    /**
     * @codeCoverageIgnore
     */
    public function deleteAny(User $user): bool
    {
        return false;
    }
}
