<?php

namespace Kumi\Kanri\Support;

class DefaultRoles
{
    public const MANAGING_DIRECTOR = 'kanri::managing-director';
    public const VICE_MANAGING_DIRECTOR = 'kanri::vice-managing-director';

    protected static array $roles = [
        [
            'name' => self::MANAGING_DIRECTOR,
            'label' => 'Managing Director',
            'description' => 'Managing Director',
        ],
        [
            'name' => self::VICE_MANAGING_DIRECTOR,
            'label' => 'Vice Managing Director',
            'description' => 'Vice Managing Director',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
