<?php

namespace Kumi\Keiri\Support;

class DefaultRoles
{
    public const ACCOUNTING_MANAGER = 'keiri::accounting-manager';
    public const ACCOUNTING_ASSISTANT = 'keiri::accounting-assistant';
    public const ACCOUNTING_USER = 'keiri::accounting-user';

    protected static array $roles = [
        [
            'name' => self::ACCOUNTING_MANAGER,
            'label' => 'Accounting Manager',
            'description' => 'Accounting Manager',
        ],
        [
            'name' => self::ACCOUNTING_ASSISTANT,
            'label' => 'Accounting Assistant',
            'description' => 'Accounting Assistant',
        ],
        [
            'name' => self::ACCOUNTING_USER,
            'label' => 'Accounting User',
            'description' => 'Accounting User',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
