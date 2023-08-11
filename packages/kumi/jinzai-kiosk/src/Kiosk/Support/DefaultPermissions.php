<?php

namespace Kumi\Kiosk\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'kiosk';

    public const VIEW_OWN_PERSONAL_INFORMATION = 'kiosk::view-own-personal-information';

    public const VIEW_ANY_PERSONAL_TICKETS = 'kiosk::view-any-personal-tickets';
    public const DELETE_ANY_PERSONAL_TICKETS = 'kiosk::delete-any-personal-tickets';
    public const CREATE_PERSONAL_TICKET = 'kiosk::create-personal-ticket';
    public const VIEW_PERSONAL_TICKET = 'kiosk::view-personal-ticket';
    public const UPDATE_PERSONAL_TICKET = 'kiosk::update-personal-ticket';
    public const DELETE_PERSONAL_TICKET = 'kiosk::delete-personal-ticket';

    public const VIEW_ANY_PERSONAL_PAYOUTS = 'kiosk::view-any-personal-payouts';
    public const DELETE_ANY_PERSONAL_PAYOUTS = 'kiosk::delete-any-personal-payouts';
    public const CREATE_PERSONAL_PAYOUT = 'kiosk::create-personal-payout';
    public const VIEW_PERSONAL_PAYOUT = 'kiosk::view-personal-payout';
    public const UPDATE_PERSONAL_PAYOUT = 'kiosk::update-personal-payout';
    public const DELETE_PERSONAL_PAYOUT = 'kiosk::delete-personal-payout';

    public const VIEW_ANY_PERSONAL_PAYOUT_ITEMS = 'kiosk::view-any-personal-payout-items';
    public const DELETE_ANY_PERSONAL_PAYOUT_ITEMS = 'kiosk::delete-any-personal-payout-items';
    public const CREATE_PERSONAL_PAYOUT_ITEM = 'kiosk::create-personal-payout-item';
    public const VIEW_PERSONAL_PAYOUT_ITEM = 'kiosk::view-personal-payout-item';
    public const UPDATE_PERSONAL_PAYOUT_ITEM = 'kiosk::update-personal-payout-item';
    public const DELETE_PERSONAL_PAYOUT_ITEM = 'kiosk::delete-personal-payout-item';

    protected static array $permissions = [
        [
            'name' => self::VIEW_OWN_PERSONAL_INFORMATION,
            'label' => 'View Own Personal Information',
            'description' => 'View Own Personal Information',
            'group' => 'information',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PERSONAL_TICKETS,
            'label' => 'View Any Personal Tickets',
            'description' => 'View Any Personal Tickets',
            'group' => 'personal-ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_PERSONAL_TICKETS,
            'label' => 'Delete Any Personal Tickets',
            'description' => 'Delete Any Personal Tickets',
            'group' => 'personal-ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_PERSONAL_TICKET,
            'label' => 'Create Personal Ticket',
            'description' => 'Create Personal Ticket',
            'group' => 'personal-ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PERSONAL_TICKET,
            'label' => 'View Personal Ticket',
            'description' => 'View Personal Ticket',
            'group' => 'personal-ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_PERSONAL_TICKET,
            'label' => 'Update Personal Ticket',
            'description' => 'Update Personal Ticket',
            'group' => 'personal-ticket',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_PERSONAL_TICKET,
            'label' => 'Delete Personal Ticket',
            'description' => 'Delete Personal Ticket',
            'group' => 'personal-ticket',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PERSONAL_PAYOUTS,
            'label' => 'View Any Personal Payouts',
            'description' => 'View Any Personal Payouts',
            'group' => 'personal-payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_PERSONAL_PAYOUTS,
            'label' => 'Delete Any Personal Payouts',
            'description' => 'Delete Any Personal Payouts',
            'group' => 'personal-payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_PERSONAL_PAYOUT,
            'label' => 'Create Personal Payout',
            'description' => 'Create Personal Payout',
            'group' => 'personal-payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PERSONAL_PAYOUT,
            'label' => 'View Personal Payout',
            'description' => 'View Personal Payout',
            'group' => 'personal-payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_PERSONAL_PAYOUT,
            'label' => 'Update Personal Payout',
            'description' => 'Update Personal Payout',
            'group' => 'personal-payout',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_PERSONAL_PAYOUT,
            'label' => 'Delete Personal Payout',
            'description' => 'Delete Personal Payout',
            'group' => 'personal-payout',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_PERSONAL_PAYOUT_ITEMS,
            'label' => 'View Any Personal Payout Items',
            'description' => 'View Any Personal Payout Items',
            'group' => 'personal-payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_PERSONAL_PAYOUT_ITEMS,
            'label' => 'Delete Any Personal Payout Items',
            'description' => 'Delete Any Personal Payout Items',
            'group' => 'personal-payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_PERSONAL_PAYOUT_ITEM,
            'label' => 'Create Personal Payout Item',
            'description' => 'Create Personal Payout Item',
            'group' => 'personal-payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_PERSONAL_PAYOUT_ITEM,
            'label' => 'View Personal Payout Item',
            'description' => 'View Personal Payout Item',
            'group' => 'personal-payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_PERSONAL_PAYOUT_ITEM,
            'label' => 'Update Personal Payout Item',
            'description' => 'Update Personal Payout Item',
            'group' => 'personal-payout-item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_PERSONAL_PAYOUT_ITEM,
            'label' => 'Delete Personal Payout Item',
            'description' => 'Delete Personal Payout Item',
            'group' => 'personal-payout-item',
            'namespace' => self::NAMESPACE,
        ],

    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
