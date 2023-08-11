<?php

namespace Kumi\Sousa\Policies;

use Kumi\Sousa\Models\OilJournal;
use Kumi\Sousa\Support\DefaultPermissions;
use Kumi\Tobira\Models\User;

class OilJournalPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_OIL_JOURNAL);
    }

    public function view(User $user, OilJournal $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_OIL_JOURNAL) && $model->isCommitted();
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_OIL_JOURNALS);
    }

    public function update(User $user, OilJournal $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_OIL_JOURNAL) && ! $model->isCommitted();
    }

    public function delete(User $user, OilJournal $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_OIL_JOURNAL) && ! $model->isCommitted();
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_OIL_JOURNALS);
    }
}
