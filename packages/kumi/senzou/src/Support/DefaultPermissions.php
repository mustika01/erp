<?php

namespace Kumi\Senzou\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'senzou';

    public const VIEW_ANY_ITEMS = 'senzou::view-any-items';
    public const DELETE_ANY_ITEMS = 'senzou::delete-any-items';
    public const CREATE_ITEM = 'senzou::create-item';
    public const VIEW_ITEM = 'senzou::view-item';
    public const UPDATE_ITEM = 'senzou::update-item';
    public const DELETE_ITEM = 'senzou::delete-item';

    public const VIEW_ANY_DELIVERY_NOTES = 'senzou::view-any-delivery-notes';
    public const DELETE_ANY_DELIVERY_NOTES = 'senzou::delete-any-delivery-notes';
    public const CREATE_DELIVERY_NOTE = 'senzou::create-delivery-note';
    public const VIEW_DELIVERY_NOTE = 'senzou::view-delivery-note';
    public const UPDATE_DELIVERY_NOTE = 'senzou::update-delivery-note';
    public const DELETE_DELIVERY_NOTE = 'senzou::delete-delivery-note';

    public const VIEW_ANY_VESSEL_USERS = 'senzou::view-any-vessel-users';
    public const DELETE_ANY_VESSEL_USERS = 'senzou::delete-any-vessel-users';
    public const CREATE_VESSEL_USER = 'senzou::create-vessel-user';
    public const VIEW_VESSEL_USER = 'senzou::view-vessel-user';
    public const UPDATE_VESSEL_USER = 'senzou::update-vessel-user';
    public const DELETE_VESSEL_USER = 'senzou::delete-vessel-user';

    public const VIEW_ANY_REQUEST_NOTES = 'senzou::view-any-request-notes';
    public const DELETE_ANY_REQUEST_NOTES = 'senzou::delete-any-request-notes';
    public const CREATE_REQUEST_NOTE = 'senzou::create-request-note';
    public const VIEW_REQUEST_NOTE = 'senzou::view-request-note';
    public const UPDATE_REQUEST_NOTE = 'senzou::update-request-note';
    public const DELETE_REQUEST_NOTE = 'senzou::delete-request-note';

    public const APPROVE_REQUEST_NOTES = 'senzou::approved-request-notes';
    public const REJECT_REQUEST_NOTES = 'senzou::rejected-request-notes';

    public const EDIT_DATE_REQUEST_NOTE = 'senzou::edit_date_request_note';
    public const PREVIEW_REQUEST_NOTE = 'senzou::preview_request_note';
    public const DOWNLOAD_REQUEST_NOTE = 'senzou::download_request_note';

    public const APPROVE_REQUEST_NOTE_ITEM = 'senzou::approved-request-note-item';
    public const REJECT_REQUEST_NOTE_ITEM = 'senzou::rejected-request-note-item';

    public const PREVIEW_DELIVERY_NOTES = 'senzou::preview-delivery-notes';
    public const DOWNLOAD_DELIVERY_NOTES = 'senzou::download-delivery-notes';

    public const VIEW_DELIVERY_NOTE_DAILY_REPORT = 'sousa::view-delivery-note-daily-report';

    public const PREVIEW_DELIVERY_NOTE_DAILY_REPORT = 'senzou::preview-delivery-note-daily-report';
    public const DOWNLOAD_DELIVERY_NOTE_DAILY_REPORT = 'senzou::download-delivery-note-daily-report';

    protected static array $permissions = [
        [
            'name' => self::VIEW_ANY_ITEMS,
            'label' => 'View Any Items',
            'description' => 'View Any Items',
            'group' => 'item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_ITEMS,
            'label' => 'Delete Any Items',
            'description' => 'Delete Any Items',
            'group' => 'item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_ITEM,
            'label' => 'Create Item',
            'description' => 'Create Item',
            'group' => 'item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_ITEM,
            'label' => 'View Item',
            'description' => 'View Item',
            'group' => 'item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_ITEM,
            'label' => 'Update Item',
            'description' => 'Update Item',
            'group' => 'item',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ITEM,
            'label' => 'Delete Item',
            'description' => 'Delete Item',
            'group' => 'item',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_DELIVERY_NOTES,
            'label' => 'View Any Delivery Notes',
            'description' => 'View Any Delivery Notes',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_DELIVERY_NOTES,
            'label' => 'Delete Any Delivery Notes',
            'description' => 'Delete Any Delivery Notes',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_DELIVERY_NOTE,
            'label' => 'Create Delivery Note',
            'description' => 'Create Delivery Note',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DELIVERY_NOTE,
            'label' => 'View Delivery Note',
            'description' => 'View Delivery Note',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_DELIVERY_NOTE,
            'label' => 'Update Delivery Note',
            'description' => 'Update Delivery Note',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_DELIVERY_NOTE,
            'label' => 'Delete Delivery Note',
            'description' => 'Delete Delivery Note',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_VESSEL_USERS,
            'label' => 'View Any Vessel Users',
            'description' => 'View Any Vessel Users',
            'group' => 'vessel-user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_VESSEL_USERS,
            'label' => 'Delete Any Vessel Users',
            'description' => 'Delete Any Vessel Users',
            'group' => 'vessel-user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_VESSEL_USER,
            'label' => 'Create Vessel User',
            'description' => 'Create Vessel User',
            'group' => 'vessel-user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_VESSEL_USER,
            'label' => 'View Vessel User',
            'description' => 'View Vessel User',
            'group' => 'vessel-user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_VESSEL_USER,
            'label' => 'Update Vessel User',
            'description' => 'Update Vessel User',
            'group' => 'vessel-user',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_VESSEL_USER,
            'label' => 'Delete V essel User',
            'description' => 'Delete Vessel User',
            'group' => 'vessel-user',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_REQUEST_NOTES,
            'label' => 'View Any Request Notes',
            'description' => 'View Any Request Notes',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_REQUEST_NOTES,
            'label' => 'Delete Any Request Notes',
            'description' => 'Delete Any Request Notes',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_REQUEST_NOTE,
            'label' => 'Create Request Note',
            'description' => 'Create Request Note',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_REQUEST_NOTE,
            'label' => 'View Request Note',
            'description' => 'View Request Note',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_REQUEST_NOTE,
            'label' => 'Update Request Note',
            'description' => 'Update Request Note',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_REQUEST_NOTE,
            'label' => 'Delete Request Note',
            'description' => 'Delete Request Note',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::APPROVE_REQUEST_NOTES,
            'label' => 'Approve Request Notes',
            'description' => 'Approve Request Notes',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::REJECT_REQUEST_NOTES,
            'label' => 'Reject Request Notes',
            'description' => 'Reject Request Notes',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::EDIT_DATE_REQUEST_NOTE,
            'label' => 'Edit Date Request Note',
            'description' => 'Edit Date Request Note',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::PREVIEW_REQUEST_NOTE,
            'label' => 'Preview Request Note',
            'description' => 'Preview Request Note',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DOWNLOAD_REQUEST_NOTE,
            'label' => 'Download Request Notes',
            'description' => 'Download Request Notes',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::APPROVE_REQUEST_NOTE_ITEM,
            'label' => 'Approve Request Note Item',
            'description' => 'Approve Request Note Item',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::REJECT_REQUEST_NOTE_ITEM,
            'label' => 'Reject Request Note Item',
            'description' => 'Reject Request Note Item',
            'group' => 'request-note',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::PREVIEW_DELIVERY_NOTES,
            'label' => 'Preview Delivery Notes',
            'description' => 'Preview Delivery Notes',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::DOWNLOAD_DELIVERY_NOTES,
            'label' => 'Download Delivery Notes',
            'description' => 'Download Delivery Notes',
            'group' => 'delivery-note',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_DELIVERY_NOTE_DAILY_REPORT,
            'label' => 'View Delivery Note Daily Report',
            'description' => 'View Delivery Note Daily Report',
            'group' => 'delivery-note-daily_report',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::PREVIEW_DELIVERY_NOTE_DAILY_REPORT,
            'label' => 'Preview Delivery Note Daily Report',
            'description' => 'Preview Delivery Note Daily Report',
            'group' => 'delivery-note-daily-report',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DOWNLOAD_DELIVERY_NOTE_DAILY_REPORT,
            'label' => 'Download Delivery Note Daily Report',
            'description' => 'Download Delivery Note Daily Report',
            'group' => 'delivery-note-daily-report',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
