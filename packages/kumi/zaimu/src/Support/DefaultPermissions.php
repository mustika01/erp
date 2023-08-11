<?php

namespace Kumi\Zaimu\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'zaimu';

    // public const VIEW_ANY_TICKETS = 'zaimu::view-any-tickets';
    // public const VIEW_HUMAN_CAPITAL_TICKETS = 'zaimu::view-human-capital-tickets';

    protected static array $permissions = [
        // [
        //     'name' => self::VIEW_ANY_TICKETS,
        //     'label' => 'View Any Tickets',
        //     'description' => 'View Any Tickets',
        //     'group' => 'ticket',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::VIEW_HUMAN_CAPITAL_TICKETS,
        //     'label' => 'View HC Tickets',
        //     'description' => 'View Human Capital Tickets',
        //     'group' => 'ticket',
        //     'namespace' => self::NAMESPACE,
        // ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
