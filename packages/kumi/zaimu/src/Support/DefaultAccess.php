<?php

namespace Kumi\Zaimu\Support;

use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
        ],

        DefaultRoles::FINANCE_MANAGER => [
        ],

        DefaultRoles::FINANCE_ASSISTANT => [
        ],

        DefaultRoles::FINANCE_USER => [
        ],

    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
