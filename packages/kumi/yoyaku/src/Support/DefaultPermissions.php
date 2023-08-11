<?php

namespace Kumi\Yoyaku\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'yoyaku';

    public const VIEW_ANY_BOOKABLES = 'yoyaku::view-any-bookables';
    public const DELETE_ANY_BOOKABLES = 'yoyaku::delete-any-bookables';
    public const CREATE_BOOKABLE = 'yoyaku::create-bookable';
    public const VIEW_BOOKABLE = 'yoyaku::view-bookable';
    public const UPDATE_BOOKABLE = 'yoyaku::update-bookable';
    public const DELETE_BOOKABLE = 'yoyaku::delete-bookable';

    public const VIEW_ANY_BOOKINGS = 'yoyaku::view-any-bookings';
    public const DELETE_ANY_BOOKINGS = 'yoyaku::delete-any-bookings';
    public const CREATE_BOOKING = 'yoyaku::create-booking';
    public const VIEW_BOOKING = 'yoyaku::view-booking';
    public const UPDATE_BOOKING = 'yoyaku::update-booking';
    public const DELETE_BOOKING = 'yoyaku::delete-booking';

    protected static array $permissions = [
        [
            'name' => self::VIEW_ANY_BOOKABLES,
            'label' => 'View Any Bookables',
            'description' => 'View Any Bookables',
            'group' => 'bookable',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_BOOKABLES,
            'label' => 'Delete Any Bookables',
            'description' => 'Delete Any Bookables',
            'group' => 'bookable',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_BOOKABLE,
            'label' => 'Create Bookable',
            'description' => 'Create Bookable',
            'group' => 'bookable',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_BOOKABLE,
            'label' => 'View Bookable',
            'description' => 'View Bookable',
            'group' => 'bookable',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_BOOKABLE,
            'label' => 'Update Bookable',
            'description' => 'Update Bookable',
            'group' => 'bookable',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_BOOKABLE,
            'label' => 'Delete Bookable',
            'description' => 'Delete Bookable',
            'group' => 'bookable',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_BOOKINGS,
            'label' => 'View Any Bookings',
            'description' => 'View Any Bookings',
            'group' => 'booking',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_BOOKINGS,
            'label' => 'Delete Any Bookings',
            'description' => 'Delete Any Bookings',
            'group' => 'booking',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_BOOKING,
            'label' => 'Create Booking',
            'description' => 'Create Booking',
            'group' => 'booking',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_BOOKING,
            'label' => 'View Booking',
            'description' => 'View Booking',
            'group' => 'booking',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_BOOKING,
            'label' => 'Update Booking',
            'description' => 'Update Booking',
            'group' => 'booking',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_BOOKING,
            'label' => 'Delete Booking',
            'description' => 'Delete Booking',
            'group' => 'booking',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
