<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Support\DefaultPermissions;

class EmploymentPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_EMPLOYMENT);
    }

    public function view(User $user, Employment $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_EMPLOYMENT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_EMPLOYMENTS);
    }

    public function update(User $user, Employment $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_EMPLOYMENT);
    }

    public function delete(User $user, Employment $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_EMPLOYMENT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_EMPLOYMENTS);
    }
}
