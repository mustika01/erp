<?php

namespace Kumi\Kiosk\Support;

use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
            DefaultPermissions::VIEW_OWN_PERSONAL_INFORMATION,
        ],

        DefaultRoles::EMPLOYEE => [
            DefaultPermissions::VIEW_OWN_PERSONAL_INFORMATION,

            DefaultPermissions::VIEW_ANY_PERSONAL_TICKETS,
            // DefaultPermissions::DELETE_ANY_PERSONAL_TICKETS,
            DefaultPermissions::CREATE_PERSONAL_TICKET,
            DefaultPermissions::VIEW_PERSONAL_TICKET,
            DefaultPermissions::UPDATE_PERSONAL_TICKET,
            // DefaultPermissions::DELETE_PERSONAL_TICKET,

            DefaultPermissions::VIEW_ANY_PERSONAL_PAYOUTS,
            // DefaultPermissions::DELETE_ANY_PERSONAL_PAYOUTS,
            // DefaultPermissions::CREATE_PERSONAL_PAYOUT,
            DefaultPermissions::VIEW_PERSONAL_PAYOUT,
            // DefaultPermissions::UPDATE_PERSONAL_PAYOUT,
            // DefaultPermissions::DELETE_PERSONAL_PAYOUT,

            DefaultPermissions::VIEW_ANY_PERSONAL_PAYOUT_ITEMS,
            // DefaultPermissions::DELETE_ANY_PERSONAL_PAYOUT_ITEMS,
            // DefaultPermissions::CREATE_PERSONAL_PAYOUT_ITEM,
            // DefaultPermissions::VIEW_PERSONAL_PAYOUT_ITEM,
            // DefaultPermissions::UPDATE_PERSONAL_PAYOUT_ITEM,
            // DefaultPermissions::DELETE_PERSONAL_PAYOUT_ITEM,
        ],

    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
