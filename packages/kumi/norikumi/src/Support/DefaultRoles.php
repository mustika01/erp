<?php

namespace Kumi\Norikumi\Support;

class DefaultRoles
{
    public const CREWING_MANAGER = 'norikumi::crewing-manager';
    public const CREWING_ASSISTANT = 'norikumi::crewing-assistant';
    public const CREWING_USER = 'norikumi::crewing-user';

    protected static array $roles = [
        [
            'name' => self::CREWING_MANAGER,
            'label' => 'Crewing Manager',
            'description' => 'Crewing Manager',
        ],
        [
            'name' => self::CREWING_ASSISTANT,
            'label' => 'Crewing Assistant',
            'description' => 'Crewing Assistant',
        ],
        [
            'name' => self::CREWING_USER,
            'label' => 'Crewing User',
            'description' => 'Crewing User',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
