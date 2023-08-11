<?php

namespace Kumi\Tobira\Support;

use Kumi\Kyoka\Support\DefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        DefaultRoles::FILAMENT_USER => [
            DefaultPermissions::ACCESS_FILAMENT,

            DefaultPermissions::MANAGE_PROFILE,
            DefaultPermissions::MANAGE_PASSWORD,
            DefaultPermissions::MANAGE_TWO_FACTOR_AUTHENTICATION,
        ],
    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
