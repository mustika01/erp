<?php

namespace Kumi\Sousa\Support;

class DefaultRoles
{
    public const OPERATIONAL_MANAGER = 'sousa::operational-manager';
    public const OPERATIONAL_ASSISTANT = 'sousa::operational-assistant';
    public const OPERATIONAL_DOCUMENT_USER = 'sousa::operational-document-user';
    public const OPERATIONAL_MONITORING_USER = 'sousa::operational-monitoring-user';
    public const OPERATIONAL_BUNKER_USER = 'sousa::operational-bunker-user';
    public const OPERATIONAL_USER = 'sousa::operational-user';

    protected static array $roles = [
        [
            'name' => self::OPERATIONAL_MANAGER,
            'label' => 'OPS Manager',
            'description' => 'Operational Manager',
        ],
        [
            'name' => self::OPERATIONAL_ASSISTANT,
            'label' => 'OPS Assistant',
            'description' => 'Operational Assistant',
        ],
        [
            'name' => self::OPERATIONAL_DOCUMENT_USER,
            'label' => 'OPS Document User',
            'description' => 'Operational Document User',
        ],
        [
            'name' => self::OPERATIONAL_MONITORING_USER,
            'label' => 'OPS Monitoring User',
            'description' => 'Operational Monitoring User',
        ],
        [
            'name' => self::OPERATIONAL_BUNKER_USER,
            'label' => 'OPS Bunker User',
            'description' => 'Operational Bunker User',
        ],
        [
            'name' => self::OPERATIONAL_USER,
            'label' => 'OPS User',
            'description' => 'Operational User',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
