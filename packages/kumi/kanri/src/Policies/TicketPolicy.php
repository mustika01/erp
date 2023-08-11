<?php

namespace Kumi\Kanri\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Kanri\Models\Ticket;
use Kumi\Kanri\Support\DefaultPermissions;

class TicketPolicy
{
    public function create(User $user): bool
    {
        return false;
    }

    public function view(User $user, Ticket $model): bool
    {
        return true;
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_TICKETS)
            || $user->can(DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS)
            || $user->can(DefaultPermissions::VIEW_ANY_LEAVE_REQUEST_TICKETS)
            || $user->can(DefaultPermissions::VIEW_DEPARTMENT_LEAVE_REQUEST_TICKETS);
    }

    public function update(User $user, Ticket $model): bool
    {
        return false;
    }

    public function delete(User $user, Ticket $model): bool
    {
        return false;
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
