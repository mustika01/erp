<?php

namespace Kumi\Senzou\Support;

use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
            DefaultPermissions::VIEW_ANY_VESSEL_USERS,
            DefaultPermissions::DELETE_ANY_VESSEL_USERS,
            DefaultPermissions::CREATE_VESSEL_USER,
            DefaultPermissions::VIEW_VESSEL_USER,
            DefaultPermissions::UPDATE_VESSEL_USER,
            DefaultPermissions::DELETE_VESSEL_USER,

            DefaultPermissions::VIEW_ANY_REQUEST_NOTES,
            // DefaultPermissions::DELETE_ANY_REQUEST_NOTES,
            // DefaultPermissions::CREATE_REQUEST_NOTE,
            DefaultPermissions::VIEW_REQUEST_NOTE,
            // DefaultPermissions::UPDATE_REQUEST_NOTE,
            // DefaultPermissions::DELETE_REQUEST_NOTE,

            DefaultPermissions::APPROVE_REQUEST_NOTES,
            DefaultPermissions::REJECT_REQUEST_NOTES,

            DefaultPermissions::EDIT_DATE_REQUEST_NOTE,
            DefaultPermissions::PREVIEW_REQUEST_NOTE,
            DefaultPermissions::DOWNLOAD_REQUEST_NOTE,

            DefaultPermissions::VIEW_ANY_ITEMS,
            DefaultPermissions::DELETE_ANY_ITEMS,
            DefaultPermissions::CREATE_ITEM,
            DefaultPermissions::VIEW_ITEM,
            DefaultPermissions::UPDATE_ITEM,
            DefaultPermissions::DELETE_ITEM,

            DefaultPermissions::VIEW_ANY_DELIVERY_NOTES,
            DefaultPermissions::DELETE_ANY_DELIVERY_NOTES,
            DefaultPermissions::CREATE_DELIVERY_NOTE,
            DefaultPermissions::VIEW_DELIVERY_NOTE,
            DefaultPermissions::UPDATE_DELIVERY_NOTE,
            DefaultPermissions::DELETE_DELIVERY_NOTE,

            DefaultPermissions::PREVIEW_DELIVERY_NOTES,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTES,

            DefaultPermissions::VIEW_DELIVERY_NOTE_DAILY_REPORT,

            DefaultPermissions::PREVIEW_DELIVERY_NOTE_DAILY_REPORT,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTE_DAILY_REPORT,
        ],

        DefaultRoles::VESSEL_WAREHOUSE_ADMIN => [
            DefaultPermissions::VIEW_ANY_VESSEL_USERS,
            DefaultPermissions::DELETE_ANY_VESSEL_USERS,
            DefaultPermissions::CREATE_VESSEL_USER,
            DefaultPermissions::VIEW_VESSEL_USER,
            DefaultPermissions::UPDATE_VESSEL_USER,
            DefaultPermissions::DELETE_VESSEL_USER,

            DefaultPermissions::VIEW_ANY_REQUEST_NOTES,
            // DefaultPermissions::DELETE_ANY_REQUEST_NOTES,
            // DefaultPermissions::CREATE_REQUEST_NOTE,
            DefaultPermissions::VIEW_REQUEST_NOTE,
            // DefaultPermissions::UPDATE_REQUEST_NOTE,
            // DefaultPermissions::DELETE_REQUEST_NOTE,

            DefaultPermissions::APPROVE_REQUEST_NOTES,
            DefaultPermissions::REJECT_REQUEST_NOTES,

            DefaultPermissions::EDIT_DATE_REQUEST_NOTE,
            DefaultPermissions::PREVIEW_REQUEST_NOTE,
            DefaultPermissions::DOWNLOAD_REQUEST_NOTE,

            DefaultPermissions::VIEW_ANY_ITEMS,
            DefaultPermissions::DELETE_ANY_ITEMS,
            DefaultPermissions::CREATE_ITEM,
            DefaultPermissions::VIEW_ITEM,
            DefaultPermissions::UPDATE_ITEM,
            DefaultPermissions::DELETE_ITEM,

            DefaultPermissions::VIEW_ANY_DELIVERY_NOTES,
            DefaultPermissions::DELETE_ANY_DELIVERY_NOTES,
            DefaultPermissions::CREATE_DELIVERY_NOTE,
            DefaultPermissions::VIEW_DELIVERY_NOTE,
            DefaultPermissions::UPDATE_DELIVERY_NOTE,
            DefaultPermissions::DELETE_DELIVERY_NOTE,

            DefaultPermissions::PREVIEW_DELIVERY_NOTES,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTES,

            DefaultPermissions::VIEW_DELIVERY_NOTE_DAILY_REPORT,

            DefaultPermissions::PREVIEW_DELIVERY_NOTE_DAILY_REPORT,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTE_DAILY_REPORT,
        ],

        DefaultRoles::VESSEL_WAREHOUSE_ASSSISTANT => [
            DefaultPermissions::VIEW_ANY_VESSEL_USERS,
            // DefaultPermissions::DELETE_ANY_VESSEL_USERS,
            DefaultPermissions::CREATE_VESSEL_USER,
            DefaultPermissions::VIEW_VESSEL_USER,
            DefaultPermissions::UPDATE_VESSEL_USER,
            // DefaultPermissions::DELETE_VESSEL_USER,

            DefaultPermissions::VIEW_ANY_REQUEST_NOTES,
            // DefaultPermissions::DELETE_ANY_REQUEST_NOTES,
            // DefaultPermissions::CREATE_REQUEST_NOTE,
            DefaultPermissions::VIEW_REQUEST_NOTE,
            // DefaultPermissions::UPDATE_REQUEST_NOTE,
            // DefaultPermissions::DELETE_REQUEST_NOTE,

            DefaultPermissions::APPROVE_REQUEST_NOTES,
            DefaultPermissions::REJECT_REQUEST_NOTES,

            DefaultPermissions::EDIT_DATE_REQUEST_NOTE,
            DefaultPermissions::PREVIEW_REQUEST_NOTE,
            DefaultPermissions::DOWNLOAD_REQUEST_NOTE,

            DefaultPermissions::VIEW_ANY_ITEMS,
            // DefaultPermissions::DELETE_ANY_ITEMS,
            DefaultPermissions::CREATE_ITEM,
            DefaultPermissions::VIEW_ITEM,
            DefaultPermissions::UPDATE_ITEM,
            // DefaultPermissions::DELETE_ITEM,

            DefaultPermissions::VIEW_ANY_DELIVERY_NOTES,
            // DefaultPermissions::DELETE_ANY_DELIVERY_NOTES,
            DefaultPermissions::CREATE_DELIVERY_NOTE,
            DefaultPermissions::VIEW_DELIVERY_NOTE,
            DefaultPermissions::UPDATE_DELIVERY_NOTE,
            // DefaultPermissions::DELETE_DELIVERY_NOTE,

            DefaultPermissions::PREVIEW_DELIVERY_NOTES,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTES,

            DefaultPermissions::VIEW_DELIVERY_NOTE_DAILY_REPORT,

            DefaultPermissions::PREVIEW_DELIVERY_NOTE_DAILY_REPORT,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTE_DAILY_REPORT,
        ],

        DefaultRoles::VESSEL_WAREHOUSE_USER => [
            DefaultPermissions::VIEW_ANY_VESSEL_USERS,
            // DefaultPermissions::DELETE_ANY_VESSEL_USERS,
            DefaultPermissions::CREATE_VESSEL_USER,
            DefaultPermissions::VIEW_VESSEL_USER,
            DefaultPermissions::UPDATE_VESSEL_USER,
            // DefaultPermissions::DELETE_VESSEL_USER,

            DefaultPermissions::VIEW_ANY_REQUEST_NOTES,
            // DefaultPermissions::DELETE_ANY_REQUEST_NOTES,
            // DefaultPermissions::CREATE_REQUEST_NOTE,
            DefaultPermissions::VIEW_REQUEST_NOTE,
            // DefaultPermissions::UPDATE_REQUEST_NOTE,
            // DefaultPermissions::DELETE_REQUEST_NOTE,

            // DefaultPermissions::APPROVE_REQUEST_NOTES,
            // DefaultPermissions::REJECT_REQUEST_NOTES,

            DefaultPermissions::EDIT_DATE_REQUEST_NOTE,
            DefaultPermissions::PREVIEW_REQUEST_NOTE,
            DefaultPermissions::DOWNLOAD_REQUEST_NOTE,

            DefaultPermissions::VIEW_ANY_ITEMS,
            // DefaultPermissions::DELETE_ANY_ITEMS,
            DefaultPermissions::CREATE_ITEM,
            DefaultPermissions::VIEW_ITEM,
            DefaultPermissions::UPDATE_ITEM,
            // DefaultPermissions::DELETE_ITEM,

            DefaultPermissions::VIEW_ANY_DELIVERY_NOTES,
            // DefaultPermissions::DELETE_ANY_DELIVERY_NOTES,
            DefaultPermissions::CREATE_DELIVERY_NOTE,
            DefaultPermissions::VIEW_DELIVERY_NOTE,
            DefaultPermissions::UPDATE_DELIVERY_NOTE,
            // DefaultPermissions::DELETE_DELIVERY_NOTE,

            DefaultPermissions::PREVIEW_DELIVERY_NOTES,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTES,

            DefaultPermissions::VIEW_DELIVERY_NOTE_DAILY_REPORT,

            DefaultPermissions::PREVIEW_DELIVERY_NOTE_DAILY_REPORT,
            DefaultPermissions::DOWNLOAD_DELIVERY_NOTE_DAILY_REPORT,
        ],
    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
