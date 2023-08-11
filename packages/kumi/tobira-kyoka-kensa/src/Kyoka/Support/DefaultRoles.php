<?php

namespace Kumi\Kyoka\Support;

class DefaultRoles
{
    public const SUPER_ADMINISTRATOR = 'kyoka::super-administrator';
    public const ADMINISTRATOR = 'kyoka::administrator';
    public const FILAMENT_USER = 'kyoka::filament-user';
    public const SYSTEM = 'kyoka::system';
    public const BOT = 'kyoka::bot';

    protected static array $roles = [
        [
            'name' => self::SUPER_ADMINISTRATOR,
            'label' => 'Super Administrator',
            'description' => 'Super Administrator',
        ],
        [
            'name' => self::ADMINISTRATOR,
            'label' => 'Administrator',
            'description' => 'Administrator',
        ],
        [
            'name' => self::FILAMENT_USER,
            'label' => 'Filament User',
            'description' => 'Filament User',
        ],
        [
            'name' => self::SYSTEM,
            'label' => 'System',
            'description' => 'This role is reserved for user accounts with automated system-related activities.',
        ],
        [
            'name' => self::BOT,
            'label' => 'Bot',
            'description' => 'This role is reserved for user accounts with automated activities.',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
