<?php

namespace Kumi\Kanshi\Support;

use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
            DefaultPermissions::VIEW_ANY_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_ACTIVITIES,
            // DefaultPermissions::CREATE_ACTIVITY,
            DefaultPermissions::VIEW_ACTIVITY,
            // DefaultPermissions::UPDATE_ACTIVITY,
            // DefaultPermissions::DELETE_ACTIVITY,

            DefaultPermissions::VIEW_ACTIVITY_DETAILS,
        ],

        DefaultRoles::AUDIT_MANAGER => [
            DefaultPermissions::VIEW_ANY_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_ACTIVITIES,
            // DefaultPermissions::CREATE_ACTIVITY,
            DefaultPermissions::VIEW_ACTIVITY,
            // DefaultPermissions::UPDATE_ACTIVITY,
            // DefaultPermissions::DELETE_ACTIVITY,

            DefaultPermissions::VIEW_ACTIVITY_DETAILS,
        ],
    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
