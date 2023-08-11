<?php

namespace Kumi\Senzou\Policies;

use Kumi\Senzou\Models\RequestNoteItem;
use Kumi\Tobira\Models\User;

class RequestNoteItemPolicy
{
    public function create(User $user): bool
    {
        return false;
    }

    public function view(User $user, RequestNoteItem $model): bool
    {
        return false;
    }

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function update(User $user, RequestNoteItem $model): bool
    {
        return false;
    }

    public function delete(User $user, RequestNoteItem $model): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
