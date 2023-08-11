<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Norikumi\Models\Contract;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class ContractPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_CONTRACT);
    }

    public function view(User $user, Contract $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_CONTRACT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_CONTRACTS);
    }

    public function update(User $user, Contract $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_CONTRACT)
            && ! $model->isExpired();
    }

    public function delete(User $user, Contract $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_CONTRACT)
            && ! $model->isExpired();
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_CONTRACTS);
    }
}
