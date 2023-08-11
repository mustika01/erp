<?php

namespace Kumi\Tobira\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'tobira';

    public const ACCESS_FILAMENT = 'tobira::access-filament';

    public const MANAGE_PROFILE = 'tobira::manage-profile';
    public const MANAGE_PASSWORD = 'tobira::manage-password';
    public const MANAGE_TWO_FACTOR_AUTHENTICATION = 'tobira::manage-two-factor-authentication';

    protected static array $permissions = [
        [
            'name' => self::ACCESS_FILAMENT,
            'label' => 'Access Filament',
            'description' => 'Access Filament',
            'group' => 'filament',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::MANAGE_PROFILE,
            'label' => 'Manage Profile',
            'description' => 'Manage Profile',
            'group' => 'fortify',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::MANAGE_PASSWORD,
            'label' => 'Manage Password',
            'description' => 'Manage Password',
            'group' => 'fortify',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::MANAGE_TWO_FACTOR_AUTHENTICATION,
            'label' => 'Manage 2FA',
            'description' => 'Manage 2FA',
            'group' => 'fortify',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
