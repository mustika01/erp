<?php

namespace Kumi\Norikumi\Policies;

use Kumi\Tobira\Models\User;
use Kumi\Norikumi\Support\DefaultPermissions;
use Kumi\Norikumi\Models\RegistrationFormEntry;

class RegistrationFormEntryPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_REGISTRATION_FORM_ENTRY);
    }

    public function view(User $user, RegistrationFormEntry $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_REGISTRATION_FORM_ENTRIES);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_REGISTRATION_FORM_ENTRIES);
    }

    public function update(User $user, RegistrationFormEntry $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_REGISTRATION_FORM_ENTRY);
    }

    public function delete(User $user, RegistrationFormEntry $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_REGISTRATION_FORM_ENTRY);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_REGISTRATION_FORM_ENTRIES);
    }
}
