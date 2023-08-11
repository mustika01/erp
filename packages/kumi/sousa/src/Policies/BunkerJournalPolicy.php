<?php

namespace Kumi\Sousa\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Sousa\Models\BunkerJournal;
use Kumi\Sousa\Support\DefaultPermissions;

class BunkerJournalPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_BUNKER_JOURNAL);
    }

    public function view(User $user, BunkerJournal $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_BUNKER_JOURNAL) && $model->isCommitted();
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS);
    }

    public function update(User $user, BunkerJournal $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_BUNKER_JOURNAL) && ! $model->isCommitted();
    }

    public function delete(User $user, BunkerJournal $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_BUNKER_JOURNAL) && ! $model->isCommitted();
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS);
    }
}
