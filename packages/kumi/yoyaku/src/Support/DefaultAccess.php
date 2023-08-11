<?php

namespace Kumi\Yoyaku\Support;

use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;
use Kumi\Jinzai\Support\DefaultRoles as JinzaiDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
            DefaultPermissions::VIEW_ANY_BOOKABLES,
            DefaultPermissions::DELETE_ANY_BOOKABLES,
            DefaultPermissions::CREATE_BOOKABLE,
            DefaultPermissions::VIEW_BOOKABLE,
            DefaultPermissions::UPDATE_BOOKABLE,
            DefaultPermissions::DELETE_BOOKABLE,

            DefaultPermissions::VIEW_ANY_BOOKINGS,
            DefaultPermissions::DELETE_ANY_BOOKINGS,
            DefaultPermissions::CREATE_BOOKING,
            DefaultPermissions::VIEW_BOOKING,
            DefaultPermissions::UPDATE_BOOKING,
            DefaultPermissions::DELETE_BOOKING,
        ],

        JinzaiDefaultRoles::HUMAN_CAPITAL_MANAGER => [
            DefaultPermissions::VIEW_ANY_BOOKABLES,
            // DefaultPermissions::DELETE_ANY_BOOKABLES,
            DefaultPermissions::CREATE_BOOKABLE,
            DefaultPermissions::VIEW_BOOKABLE,
            DefaultPermissions::UPDATE_BOOKABLE,
            // DefaultPermissions::DELETE_BOOKABLE,

            DefaultPermissions::VIEW_ANY_BOOKINGS,
            // DefaultPermissions::DELETE_ANY_BOOKINGS,
            DefaultPermissions::CREATE_BOOKING,
            DefaultPermissions::VIEW_BOOKING,
            DefaultPermissions::UPDATE_BOOKING,
            // DefaultPermissions::DELETE_BOOKING,
        ],

        JinzaiDefaultRoles::HUMAN_CAPITAL_ASSISTANT => [
            DefaultPermissions::VIEW_ANY_BOOKABLES,
            // DefaultPermissions::DELETE_ANY_BOOKABLES,
            DefaultPermissions::CREATE_BOOKABLE,
            DefaultPermissions::VIEW_BOOKABLE,
            DefaultPermissions::UPDATE_BOOKABLE,
            // DefaultPermissions::DELETE_BOOKABLE,

            DefaultPermissions::VIEW_ANY_BOOKINGS,
            // DefaultPermissions::DELETE_ANY_BOOKINGS,
            DefaultPermissions::CREATE_BOOKING,
            DefaultPermissions::VIEW_BOOKING,
            DefaultPermissions::UPDATE_BOOKING,
            // DefaultPermissions::DELETE_BOOKING,
        ],

        JinzaiDefaultRoles::HUMAN_CAPITAL_USER => [
            DefaultPermissions::VIEW_ANY_BOOKABLES,
            // DefaultPermissions::DELETE_ANY_BOOKABLES,
            DefaultPermissions::CREATE_BOOKABLE,
            DefaultPermissions::VIEW_BOOKABLE,
            DefaultPermissions::UPDATE_BOOKABLE,
            // DefaultPermissions::DELETE_BOOKABLE,

            DefaultPermissions::VIEW_ANY_BOOKINGS,
            // DefaultPermissions::DELETE_ANY_BOOKINGS,
            DefaultPermissions::CREATE_BOOKING,
            DefaultPermissions::VIEW_BOOKING,
            DefaultPermissions::UPDATE_BOOKING,
            // DefaultPermissions::DELETE_BOOKING,
        ],

    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
