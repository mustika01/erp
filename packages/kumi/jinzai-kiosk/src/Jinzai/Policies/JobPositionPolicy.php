<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\JobPosition;
use Kumi\Jinzai\Support\DefaultPermissions;

class JobPositionPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_JOB_POSITION);
    }

    public function view(User $user, JobPosition $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_JOB_POSITION);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_JOB_POSITIONS);
    }

    public function update(User $user, JobPosition $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_JOB_POSITION);
    }

    public function delete(User $user, JobPosition $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_JOB_POSITION);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_JOB_POSITIONS);
    }
}
