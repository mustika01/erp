<?php

namespace Kumi\Zaimu\Support;

class DefaultRoles
{
    public const FINANCE_MANAGER = 'zaimu::finance-manager';
    public const FINANCE_ASSISTANT = 'zaimu::finance-assistant';
    public const FINANCE_USER = 'zaimu::finance-user';

    protected static array $roles = [
        [
            'name' => self::FINANCE_MANAGER,
            'label' => 'Finance Manager',
            'description' => 'Finance Manager',
        ],
        [
            'name' => self::FINANCE_ASSISTANT,
            'label' => 'Finance Assistant',
            'description' => 'Finance Assistant',
        ],
        [
            'name' => self::FINANCE_USER,
            'label' => 'Finance User',
            'description' => 'Finance User',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
