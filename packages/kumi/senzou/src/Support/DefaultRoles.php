<?php

namespace Kumi\Senzou\Support;

class DefaultRoles
{
    public const VESSEL_WAREHOUSE_ADMIN = 'senzou::vessel-warehouse-admin';
    public const VESSEL_WAREHOUSE_ASSSISTANT = 'senzou::vessel-warehouse-assistant';
    public const VESSEL_WAREHOUSE_USER = 'senzou::vessel-warehouse-user';

    protected static array $roles = [
        [
            'name' => self::VESSEL_WAREHOUSE_ADMIN,
            'label' => 'Vessel Warehouse Admin',
            'description' => 'Vessel Warehouse Admin',
        ],
        [
            'name' => self::VESSEL_WAREHOUSE_ASSSISTANT,
            'label' => 'Vessel Warehouse Assistant',
            'description' => 'Vessel Warehouse Assistant',
        ],
        [
            'name' => self::VESSEL_WAREHOUSE_USER,
            'label' => 'Vessel Warehouse User',
            'description' => 'Vessel Warehouse User',
        ],
    ];

    public static function getRoles(): array
    {
        return self::$roles;
    }
}
