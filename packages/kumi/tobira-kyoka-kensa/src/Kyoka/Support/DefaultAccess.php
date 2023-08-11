<?php

namespace Kumi\Kyoka\Support;

class DefaultAccess
{
    protected static array $access = [
        DefaultRoles::ADMINISTRATOR => [
            DefaultPermissions::VIEW_ANY_ROLES,
            DefaultPermissions::DELETE_ANY_ROLES,
            DefaultPermissions::CREATE_ROLE,
            DefaultPermissions::VIEW_ROLE,
            DefaultPermissions::UPDATE_ROLE,
            DefaultPermissions::DELETE_ROLE,

            DefaultPermissions::VIEW_ANY_USERS,
            DefaultPermissions::DELETE_ANY_USERS,
            DefaultPermissions::CREATE_USER,
            DefaultPermissions::VIEW_USER,
            DefaultPermissions::UPDATE_USER,
            DefaultPermissions::DELETE_USER,

            DefaultPermissions::ACTIVATE_USER,
            DefaultPermissions::DEACTIVATE_USER,

            DefaultPermissions::UPDATE_USER_PASSWORD,
            DefaultPermissions::IMPERSONATE_USER,

            DefaultPermissions::VIEW_ANY_USER_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_USER_ACTIVITIES,
            // DefaultPermissions::CREATE_USER_ACTIVITY,
            DefaultPermissions::VIEW_USER_ACTIVITY,
            // DefaultPermissions::UPDATE_USER_ACTIVITY,
            // DefaultPermissions::DELETE_USER_ACTIVITY,
            DefaultPermissions::VIEW_RECENT_USER_ACTIVITIES,
        ],
    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
