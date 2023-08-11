<?php

namespace Kumi\Kyoka\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'kyoka';

    public const VIEW_ANY_ROLES = 'kyoka::view-any-roles';
    public const DELETE_ANY_ROLES = 'kyoka::delete-any-roles';
    public const CREATE_ROLE = 'kyoka::create-role';
    public const VIEW_ROLE = 'kyoka::view-role';
    public const UPDATE_ROLE = 'kyoka::update-role';
    public const DELETE_ROLE = 'kyoka::delete-role';

    public const VIEW_ANY_USERS = 'kyoka::view-any-users';
    public const DELETE_ANY_USERS = 'kyoka::delete-any-users';
    public const CREATE_USER = 'kyoka::create-user';
    public const VIEW_USER = 'kyoka::view-user';
    public const UPDATE_USER = 'kyoka::update-user';
    public const DELETE_USER = 'kyoka::delete-user';

    public const ACTIVATE_USER = 'kyoka::activate-user';
    public const DEACTIVATE_USER = 'kyoka::deactivate-user';

    public const UPDATE_USER_PASSWORD = 'kyoka::update-user-password';
    public const IMPERSONATE_USER = 'kyoka::impersonate-user';

    public const VIEW_ANY_USER_ACTIVITIES = 'jinzai::view-any-user-activities';
    // public const DELETE_ANY_USER_ACTIVITIES = 'jinzai::delete-any-user-activities';
    // public const CREATE_USER_ACTIVITY = 'jinzai::create-user-activity';
    public const VIEW_USER_ACTIVITY = 'jinzai::view-user-activity';
    // public const UPDATE_USER_ACTIVITY = 'jinzai::update-user-activity';
    // public const DELETE_USER_ACTIVITY = 'jinzai::delete-user-activity';
    public const VIEW_RECENT_USER_ACTIVITIES = 'jinzai::view-recent-user-activities';

    protected static array $permissions = [
        [
            'name' => self::VIEW_ANY_ROLES,
            'label' => 'View Any Roles',
            'description' => 'View Any Roles',
            'group' => 'role',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_ROLES,
            'label' => 'Delete Any Roles',
            'description' => 'Delete Any Roles',
            'group' => 'role',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_ROLE,
            'label' => 'Create Role',
            'description' => 'Create Role',
            'group' => 'role',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_ROLE,
            'label' => 'View Role',
            'description' => 'View Role',
            'group' => 'role',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_ROLE,
            'label' => 'Update Role',
            'description' => 'Update Role',
            'group' => 'role',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ROLE,
            'label' => 'Delete Role',
            'description' => 'Delete Role',
            'group' => 'role',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_USERS,
            'label' => 'View Any Users',
            'description' => 'View Any Users',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_USERS,
            'label' => 'Delete Any Users',
            'description' => 'Delete Any Users',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_USER,
            'label' => 'Create User',
            'description' => 'Create User',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_USER,
            'label' => 'View User',
            'description' => 'View User',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_USER,
            'label' => 'Update User',
            'description' => 'Update User',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_USER,
            'label' => 'Delete User',
            'description' => 'Delete User',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::ACTIVATE_USER,
            'label' => 'Activate User',
            'description' => 'Activate User',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DEACTIVATE_USER,
            'label' => 'Deactivate User',
            'description' => 'Deactivate User',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::UPDATE_USER_PASSWORD,
            'label' => 'Update User Password',
            'description' => 'Update User Password',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::IMPERSONATE_USER,
            'label' => 'Impersonate User',
            'description' => 'Impersonate User',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_USER_ACTIVITIES,
            'label' => 'View Any User Activities',
            'description' => 'View Any User Activities',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::DELETE_ANY_USER_ACTIVITIES,
        //     'label' => 'Delete Any User Activities',
        //     'description' => 'Delete Any User Activities',
        //     'group' => 'user',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::CREATE_USER_ACTIVITY,
        //     'label' => 'Create User Activity',
        //     'description' => 'Create User Activity',
        //     'group' => 'user',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::VIEW_USER_ACTIVITY,
            'label' => 'View User Activity',
            'description' => 'View User Activity',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::UPDATE_USER_ACTIVITY,
        //     'label' => 'Update User Activity',
        //     'description' => 'Update User Activity',
        //     'group' => 'user',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::DELETE_USER_ACTIVITY,
        //     'label' => 'Delete User Activity',
        //     'description' => 'Delete User Activity',
        //     'group' => 'user',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::VIEW_RECENT_USER_ACTIVITIES,
            'label' => 'View Recent User Activities',
            'description' => 'View Recent User Activities',
            'group' => 'user',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
