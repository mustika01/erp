<?php

namespace Kumi\Kanshi\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'kanshi';

    public const VIEW_ANY_ACTIVITIES = 'kanshi::view-any-activities';
    public const DELETE_ANY_ACTIVITIES = 'kanshi::delete-any-activities';
    public const CREATE_ACTIVITY = 'kanshi::create-activity';
    public const VIEW_ACTIVITY = 'kanshi::view-activity';
    public const UPDATE_ACTIVITY = 'kanshi::update-activity';
    public const DELETE_ACTIVITY = 'kanshi::delete-activity';

    public const VIEW_ACTIVITY_DETAILS = 'kanshi::view-activity-details';

    protected static array $permissions = [
        [
            'name' => self::VIEW_ANY_ACTIVITIES,
            'label' => 'View Any Activities',
            'description' => 'View Any Activities',
            'group' => 'activity',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::DELETE_ANY_ACTIVITIES,
        //     'label' => 'Delete Any Activities',
        //     'description' => 'Delete Any Activities',
        //     'group' => 'activity',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::CREATE_ACTIVITY,
        //     'label' => 'Create Activity',
        //     'description' => 'Create Activity',
        //     'group' => 'activity',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::VIEW_ACTIVITY,
            'label' => 'View Activity',
            'description' => 'View Activity',
            'group' => 'activity',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::UPDATE_ACTIVITY,
        //     'label' => 'Update Activity',
        //     'description' => 'Update Activity',
        //     'group' => 'activity',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::DELETE_ACTIVITY,
        //     'label' => 'Delete Activity',
        //     'description' => 'Delete Activity',
        //     'group' => 'activity',
        //     'namespace' => self::NAMESPACE,
        // ],

        [
            'name' => self::VIEW_ACTIVITY_DETAILS,
            'label' => 'View Activity Details',
            'description' => 'View Activity Details',
            'group' => 'activity',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
