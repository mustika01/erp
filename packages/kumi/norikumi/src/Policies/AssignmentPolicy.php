<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Norikumi\Models\Assignment;
use Kumi\Norikumi\Support\DefaultPermissions;

class AssignmentPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_ASSIGNMENT);
    }

    public function view(User $user, Assignment $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_ASSIGNMENT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_ASSIGNMENTS);
    }

    public function update(User $user, Assignment $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_ASSIGNMENT);
    }

    public function delete(User $user, Assignment $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_ASSIGNMENT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_ASSIGNMENTS);
    }
}
