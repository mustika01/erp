<?php

namespace Kumi\Senzou\Policies;

use Kumi\Senzou\Models\RequestNote;
use Kumi\Senzou\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class RequestNotePolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_REQUEST_NOTE);
    }

    public function view(User $user, RequestNote $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_REQUEST_NOTE);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_REQUEST_NOTES);
    }

    public function update(User $user, RequestNote $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_REQUEST_NOTE);
    }

    public function delete(User $user, RequestNote $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_REQUEST_NOTE);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_REQUEST_NOTES);
    }
}
