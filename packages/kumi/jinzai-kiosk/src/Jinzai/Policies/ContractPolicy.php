<?php

namespace Kumi\Jinzai\Policies;

use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class ContractPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_CONTRACT);
    }

    public function view(User $user, Employment $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_CONTRACT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_CONTRACTS);
    }

    public function update(User $user, Employment $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_CONTRACT);
    }

    public function delete(User $user, Employment $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_CONTRACT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_CONTRACTS);
    }
}
