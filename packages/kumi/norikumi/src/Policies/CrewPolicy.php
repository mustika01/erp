<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Support\DefaultPermissions;

class CrewPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_CREW);
    }

    public function view(User $user, Crew $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_CREW);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_CREWS);
    }

    public function update(User $user, Crew $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_CREW);
    }

    public function delete(User $user, Crew $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_CREW);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_CREWS);
    }
}
