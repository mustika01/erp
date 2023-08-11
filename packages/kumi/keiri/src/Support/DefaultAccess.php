<?php

namespace Kumi\Keiri\Support;

use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
        ],

        DefaultRoles::ACCOUNTING_MANAGER => [
        ],

        DefaultRoles::ACCOUNTING_ASSISTANT => [
        ],

        DefaultRoles::ACCOUNTING_USER => [
        ],

    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
