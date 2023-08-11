<?php

namespace Kumi\Kanshi\Support;

class DefaultRoles
{
    public const AUDIT_MANAGER = 'kanshi::audit-manager';
    public const AUDIT_ASSISTANT = 'kanshi::audit-assistant';
    public const AUDIT_USER = 'kanshi::audit-user';

    protected static array $roles = [
        [
            'name' => self::AUDIT_MANAGER,
            'label' => 'Audit Manager',
            'description' => 'Audit Manager',
        ],
        [
            'name' => self::AUDIT_ASSISTANT,
            'label' => 'Audit Assistant',
            'description' => 'Audit Assistant',
        ],
        [
            'name' => self::AUDIT_USER,
            'label' => 'Audit User',
            'description' => 'Audit User',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
