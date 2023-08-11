<?php

namespace Kumi\Jinzai\Support;

class DefaultRoles
{
    public const HUMAN_CAPITAL_MANAGER = 'jinzai::human-capital-manager';
    public const HUMAN_CAPITAL_ASSISTANT = 'jinzai::human-capital-assistant';
    public const HUMAN_CAPITAL_USER = 'jinzai::human-capital-user';
    public const LEGAL_OFFICER = 'jinzai::legal-officer';

    protected static array $roles = [
        [
            'name' => self::HUMAN_CAPITAL_MANAGER,
            'label' => 'HC Manager',
            'description' => 'Human Capital Manager',
        ],
        [
            'name' => self::HUMAN_CAPITAL_ASSISTANT,
            'label' => 'HC Assistant',
            'description' => 'Human Capital Assistant',
        ],
        [
            'name' => self::HUMAN_CAPITAL_USER,
            'label' => 'HC User',
            'description' => 'Human Capital User',
        ],

        [
            'name' => self::LEGAL_OFFICER,
            'label' => 'Legal Officer',
            'description' => 'Legal Officer',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
