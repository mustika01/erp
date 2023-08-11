<?php

namespace Kumi\Kiosk\Support;

class DefaultRoles
{
    public const EMPLOYEE = 'kiosk::employee';

    protected static array $roles = [
        [
            'name' => self::EMPLOYEE,
            'label' => 'Employee',
            'description' => 'Employee',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
