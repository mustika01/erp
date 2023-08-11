<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Norikumi\Models\Document;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class DocumentPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_DOCUMENT);
    }

    public function view(User $user, Document $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_DOCUMENT);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_DOCUMENTS);
    }

    public function update(User $user, Document $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_DOCUMENT);
    }

    public function delete(User $user, Document $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_DOCUMENT);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_DOCUMENTS);
    }
}
