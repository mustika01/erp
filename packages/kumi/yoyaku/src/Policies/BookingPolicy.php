<?php

namespace Kumi\Yoyaku\Policies;

use Kumi\Yoyaku\Models\Booking;
use Illuminate\Foundation\Auth\User;
use Kumi\Yoyaku\Support\DefaultPermissions;

class BookingPolicy
{
    public function create(User $user): bool
    {
        return $user->can(DefaultPermissions::CREATE_BOOKING);
    }

    public function view(User $user, Booking $model): bool
    {
        return $user->can(DefaultPermissions::VIEW_BOOKING);
    }

    public function viewAny(User $user): bool
    {
        return $user->can(DefaultPermissions::VIEW_ANY_BOOKINGS);
    }

    public function update(User $user, Booking $model): bool
    {
        return $user->can(DefaultPermissions::UPDATE_BOOKING);
    }

    public function delete(User $user, Booking $model): bool
    {
        return $user->can(DefaultPermissions::DELETE_BOOKING);
    }

    public function deleteAny(User $user): bool
    {
        return $user->can(DefaultPermissions::DELETE_ANY_BOOKINGS);
    }
}
