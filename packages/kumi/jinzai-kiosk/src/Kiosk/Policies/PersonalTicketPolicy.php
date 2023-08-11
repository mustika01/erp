<?php

namespace Kumi\Kiosk\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Kiosk\Models\PersonalTicket;
use Kumi\Kiosk\Support\DefaultPermissions;

class PersonalTicketPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_PERSONAL_TICKET);
    }

    public function view(User $user, PersonalTicket $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_PERSONAL_TICKET)
            && $model->employee->user->is($user);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_PERSONAL_TICKETS);
    }

    public function update(User $user, PersonalTicket $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_PERSONAL_TICKET)
            && $model->employee->user->is($user)
            && $model->isPending();
    }

    public function delete(User $user, PersonalTicket $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_PERSONAL_TICKET)
            && $model->employee->user->is($user);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_PERSONAL_TICKETS);
    }
}
