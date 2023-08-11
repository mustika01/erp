<?php

namespace Kumi\Sousa\Support;

class DefaultPermissions
{
    public const NAMESPACE = 'sousa';

    public const OVERVIEW_SOUSA = 'sousa::overview-sousa';

    public const VIEW_ANY_VESSELS = 'sousa::view-any-vessels';
    public const DELETE_ANY_VESSELS = 'sousa::delete-any-vessels';
    public const CREATE_VESSEL = 'sousa::create-vessel';
    public const VIEW_VESSEL = 'sousa::view-vessel';
    public const UPDATE_VESSEL = 'sousa::update-vessel';
    public const DELETE_VESSEL = 'sousa::delete-vessel';

    public const VIEW_VESSEL_DASHBOARD = 'sousa::view-vessel-dashboard';
    public const VIEW_DESTINATION_CHARTS = 'sousa::view-destination-charts';

    public const PREVIEW_VESSEL_SHIP_PARTICULARS = 'sousa::preview-vessel-ship-particulars';
    public const DOWNLOAD_VESSEL_SHIP_PARTICULARS = 'sousa::download-vessel-ship-particulars';

    public const PREVIEW_EXPIRING_DOCUMENTS = 'sousa::preview-expiring-documents';
    public const DOWNLOAD_EXPIRING_DOCUMENTS = 'sousa::download-expiring-documents';

    public const VIEW_ANY_VESSEL_DOCUMENTS = 'sousa::view-any-vessel-documents';
    public const DELETE_ANY_VESSEL_DOCUMENTS = 'sousa::delete-any-vessel-documents';
    public const CREATE_VESSEL_DOCUMENT = 'sousa::create-vessel-document';
    public const VIEW_VESSEL_DOCUMENT = 'sousa::view-vessel-document';
    public const UPDATE_VESSEL_DOCUMENT = 'sousa::update-vessel-document';
    public const DELETE_VESSEL_DOCUMENT = 'sousa::delete-vessel-document';

    public const VIEW_ANY_VESSEL_VOYAGES = 'sousa::view-any-vessel-voyages';
    public const DELETE_ANY_VESSEL_VOYAGES = 'sousa::delete-any-vessel-voyages';
    public const CREATE_VESSEL_VOYAGE = 'sousa::create-vessel-voyage';
    public const VIEW_VESSEL_VOYAGE = 'sousa::view-vessel-voyage';
    public const UPDATE_VESSEL_VOYAGE = 'sousa::update-vessel-voyage';
    public const DELETE_VESSEL_VOYAGE = 'sousa::delete-vessel-voyage';

    public const VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES = 'jinzai::view-any-vessel-voyage-activities';
    // public const DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES = 'jinzai::delete-any-vessel-voyage-activities';
    // public const CREATE_VESSEL_VOYAGE_ACTIVITY = 'jinzai::create-vessel-voyage-activity';
    public const VIEW_VESSEL_VOYAGE_ACTIVITY = 'jinzai::view-vessel-voyage-activity';
    // public const UPDATE_VESSEL_VOYAGE_ACTIVITY = 'jinzai::update-vessel-voyage-activity';
    // public const DELETE_VESSEL_VOYAGE_ACTIVITY = 'jinzai::delete-vessel-voyage-activity';

    public const VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES = 'jinzai::view-recent-vessel-voyage-activities';
    public const VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS = 'jinzai::view-vessel-voyage-activity-details';

    public const VIEW_ANY_VOYAGE_STATUSES = 'sousa::view-any-voyage-statuses';
    public const DELETE_ANY_VOYAGE_STATUSES = 'sousa::delete-any-voyage-statuses';
    public const CREATE_VOYAGE_STATUS = 'sousa::create-voyage-status';
    public const VIEW_VOYAGE_STATUS = 'sousa::view-voyage-status';
    public const UPDATE_VOYAGE_STATUS = 'sousa::update-voyage-status';
    public const DELETE_VOYAGE_STATUS = 'sousa::delete-voyage-status';

    public const VIEW_ANY_CARGO_LOGS = 'sousa::view-any-cargo-logs';
    public const DELETE_ANY_CARGO_LOGS = 'sousa::delete-any-cargo-logs';
    public const CREATE_CARGO_LOG = 'sousa::create-cargo-log';
    public const VIEW_CARGO_LOG = 'sousa::view-cargo-log';
    public const UPDATE_CARGO_LOG = 'sousa::update-cargo-log';
    public const DELETE_CARGO_LOG = 'sousa::delete-cargo-log';

    public const VIEW_ANY_BUNKERS = 'sousa::view-any-bunkers';
    public const DELETE_ANY_BUNKERS = 'sousa::delete-any-bunkers';
    public const CREATE_BUNKER = 'sousa::create-bunker';
    public const VIEW_BUNKER = 'sousa::view-bunker';
    public const UPDATE_BUNKER = 'sousa::update-bunker';
    public const DELETE_BUNKER = 'sousa::delete-bunker';

    public const VIEW_ANY_BUNKER_FORMULAS = 'sousa::view-any-bunker-formulas';
    public const DELETE_ANY_BUNKER_FORMULAS = 'sousa::delete-any-bunker-formulas';
    public const CREATE_BUNKER_FORMULA = 'sousa::create-bunker-formula';
    public const VIEW_BUNKER_FORMULA = 'sousa::view-bunker-formula';
    public const UPDATE_BUNKER_FORMULA = 'sousa::update-bunker-formula';
    public const DELETE_BUNKER_FORMULA = 'sousa::delete-bunker-formula';

    public const VIEW_ANY_BUNKER_JOURNALS = 'sousa::view-any-bunker-journals';
    public const DELETE_ANY_BUNKER_JOURNALS = 'sousa::delete-any-bunker-journals';
    public const CREATE_BUNKER_JOURNAL = 'sousa::create-bunker-journal';
    public const VIEW_BUNKER_JOURNAL = 'sousa::view-bunker-journal';
    public const UPDATE_BUNKER_JOURNAL = 'sousa::update-bunker-journal';
    public const DELETE_BUNKER_JOURNAL = 'sousa::delete-bunker-journal';

    public const VIEW_ANY_OIL_JOURNALS = 'sousa::view-any-oil-journals';
    public const DELETE_ANY_OIL_JOURNALS = 'sousa::delete-any-oil-journals';
    public const CREATE_OIL_JOURNAL = 'sousa::create-oil-journal';
    public const VIEW_OIL_JOURNAL = 'sousa::view-oil-journal';
    public const UPDATE_OIL_JOURNAL = 'sousa::update-oil-journal';
    public const DELETE_OIL_JOURNAL = 'sousa::delete-oil-journal';

    public const DOWNLOAD_STATUSES_VOYAGE = 'sousa::download-statuses-voyage';

    protected static array $permissions = [
        [
            'name' => self::OVERVIEW_SOUSA,
            'label' => 'Overview Sousa',
            'description' => 'Overview Sousa',
            'group' => 'overview',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_VESSELS,
            'label' => 'View Any Vessels',
            'description' => 'View Any Vessels',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_VESSELS,
            'label' => 'Delete Any Vessels',
            'description' => 'Delete Any Vessels',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_VESSEL,
            'label' => 'Create Vessel',
            'description' => 'Create Vessel',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_VESSEL,
            'label' => 'View Vessel',
            'description' => 'View Vessel',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_VESSEL,
            'label' => 'Update Vessel',
            'description' => 'Update Vessel',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_VESSEL,
            'label' => 'Delete Vessel',
            'description' => 'Delete Vessel',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_VESSEL_DASHBOARD,
            'label' => 'View Vessel Dashboard',
            'description' => 'View Vessel Dashboard',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_DESTINATION_CHARTS,
            'label' => 'View Destination Charts',
            'description' => 'View Destination Charts',
            'group' => 'vessel-overview',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::PREVIEW_VESSEL_SHIP_PARTICULARS,
            'label' => 'Preview Vessel Ship Particulars',
            'description' => 'Preview Vessel Ship Particulars',
            'group' => 'vessel-overview',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DOWNLOAD_VESSEL_SHIP_PARTICULARS,
            'label' => 'Download Vessel Ship Particulars',
            'description' => 'Download Vessel Ship Particulars',
            'group' => 'vessel',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::PREVIEW_EXPIRING_DOCUMENTS,
            'label' => 'Preview Expiring Documents',
            'description' => 'Preview Expiring Documents',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DOWNLOAD_EXPIRING_DOCUMENTS,
            'label' => 'Download Expiring Documents',
            'description' => 'Download Expiring Documents',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_VESSEL_DOCUMENTS,
            'label' => 'View Any Vessel Documents',
            'description' => 'View Any Vessel Documents',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_VESSEL_DOCUMENTS,
            'label' => 'Delete Any Vessel Documents',
            'description' => 'Delete Any Vessel Documents',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_VESSEL_DOCUMENT,
            'label' => 'Create Vessel Document',
            'description' => 'Create Vessel Document',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_VESSEL_DOCUMENT,
            'label' => 'View Vessel Document',
            'description' => 'View Vessel Document',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_VESSEL_DOCUMENT,
            'label' => 'Update Vessel Document',
            'description' => 'Update Vessel Document',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_VESSEL_DOCUMENT,
            'label' => 'Delete Vessel Document',
            'description' => 'Delete Vessel Document',
            'group' => 'vessel-document',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_VESSEL_VOYAGES,
            'label' => 'View Any Vessel Voyages',
            'description' => 'View Any Vessel Voyages',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_VESSEL_VOYAGES,
            'label' => 'Delete Any Vessel Voyages',
            'description' => 'Delete Any Vessel Voyages',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_VESSEL_VOYAGE,
            'label' => 'Create Vessel Voyage',
            'description' => 'Create Vessel Voyage',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_VESSEL_VOYAGE,
            'label' => 'View Vessel Voyage',
            'description' => 'View Vessel Voyage',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_VESSEL_VOYAGE,
            'label' => 'Update Vessel Voyage',
            'description' => 'Update Vessel Voyage',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_VESSEL_VOYAGE,
            'label' => 'Delete Vessel Voyage',
            'description' => 'Delete Vessel Voyage',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            'label' => 'View Any Vessel Voyage Activities',
            'description' => 'View Any Vessel Voyage Activities',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::DOWNLOAD_STATUSES_VOYAGE,
            'label' => 'Download Statuses Voyage',
            'description' => 'Download Statuses Voyage',
            'group' => 'voyage-status',
            'namespace' => self::NAMESPACE,
        ],

        // [
        //     'name' => self::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
        //     'label' => 'Delete Any Vessel Voyage Activities',
        //     'description' => 'Delete Any Vessel Voyage Activities',
        //     'group' => 'vessel-voyage',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::CREATE_VESSEL_VOYAGE_ACTIVITY,
        //     'label' => 'Create Vessel Voyage Activity',
        //     'description' => 'Create Vessel Voyage Activity',
        //     'group' => 'vessel-voyage',
        //     'namespace' => self::NAMESPACE,
        // ],
        [
            'name' => self::VIEW_VESSEL_VOYAGE_ACTIVITY,
            'label' => 'View Vessel Voyage Activity',
            'description' => 'View Vessel Voyage Activity',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],
        // [
        //     'name' => self::UPDATE_VESSEL_VOYAGE_ACTIVITY,
        //     'label' => 'Update Vessel Voyage Activity',
        //     'description' => 'Update Vessel Voyage Activity',
        //     'group' => 'vessel-voyage',
        //     'namespace' => self::NAMESPACE,
        // ],
        // [
        //     'name' => self::DELETE_VESSEL_VOYAGE_ACTIVITY,
        //     'label' => 'Delete Vessel Voyage Activity',
        //     'description' => 'Delete Vessel Voyage Activity',
        //     'group' => 'vessel-voyage',
        //     'namespace' => self::NAMESPACE,
        // ],

        [
            'name' => self::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            'label' => 'View Recent Vessel Voyage Activities',
            'description' => 'View Recent Vessel Voyage Activities',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,
            'label' => 'View Vessel Voyage Activity Details',
            'description' => 'View Vessel Voyage Activity Details',
            'group' => 'vessel-voyage',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_VOYAGE_STATUSES,
            'label' => 'View Any Voyage Statuses',
            'description' => 'View Any Voyage Statuses',
            'group' => 'voyage-status',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_VOYAGE_STATUSES,
            'label' => 'Delete Any Voyage Statuses',
            'description' => 'Delete Any Voyage Statuses',
            'group' => 'voyage-status',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_VOYAGE_STATUS,
            'label' => 'Create Voyage Status',
            'description' => 'Create Voyage Status',
            'group' => 'voyage-status',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_VOYAGE_STATUS,
            'label' => 'View Voyage Status',
            'description' => 'View Voyage Status',
            'group' => 'voyage-status',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_VOYAGE_STATUS,
            'label' => 'Update Voyage Status',
            'description' => 'Update Voyage Status',
            'group' => 'voyage-status',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_VOYAGE_STATUS,
            'label' => 'Delete Voyage Status',
            'description' => 'Delete Voyage Status',
            'group' => 'voyage-status',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_CARGO_LOGS,
            'label' => 'View Any Cargo Logs',
            'description' => 'View Any Cargo Logs',
            'group' => 'cargo-log',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_CARGO_LOGS,
            'label' => 'Delete Any Cargo Logs',
            'description' => 'Delete Any Cargo Logs',
            'group' => 'cargo-log',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_CARGO_LOG,
            'label' => 'Create Cargo Log',
            'description' => 'Create Cargo Log',
            'group' => 'cargo-log',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_CARGO_LOG,
            'label' => 'View Cargo Log',
            'description' => 'View Cargo Log',
            'group' => 'cargo-log',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_CARGO_LOG,
            'label' => 'Update Cargo Log',
            'description' => 'Update Cargo Log',
            'group' => 'cargo-log',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_CARGO_LOG,
            'label' => 'Delete Cargo Log',
            'description' => 'Delete Cargo Log',
            'group' => 'cargo-log',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_BUNKERS,
            'label' => 'View Any Bunkers',
            'description' => 'View Any Bunkers',
            'group' => 'bunker',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_BUNKERS,
            'label' => 'Delete Any Bunkers',
            'description' => 'Delete Any Bunkers',
            'group' => 'bunker',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_BUNKER,
            'label' => 'Create Bunker',
            'description' => 'Create Bunker',
            'group' => 'bunker',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_BUNKER,
            'label' => 'View Bunker',
            'description' => 'View Bunker',
            'group' => 'bunker',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_BUNKER,
            'label' => 'Update Bunker',
            'description' => 'Update Bunker',
            'group' => 'bunker',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_BUNKER,
            'label' => 'Delete Bunker',
            'description' => 'Delete Bunker',
            'group' => 'bunker',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_BUNKER_FORMULAS,
            'label' => 'View Any Bunker Formulas',
            'description' => 'View Any Bunker Formulas',
            'group' => 'bunker-formula',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_BUNKER_FORMULAS,
            'label' => 'Delete Any Bunker Formulas',
            'description' => 'Delete Any Bunker Formulas',
            'group' => 'bunker-formula',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_BUNKER_FORMULA,
            'label' => 'Create Bunker Formula',
            'description' => 'Create Bunker Formula',
            'group' => 'bunker-formula',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_BUNKER_FORMULA,
            'label' => 'View Bunker Formula',
            'description' => 'View Bunker Formula',
            'group' => 'bunker-formula',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_BUNKER_FORMULA,
            'label' => 'Update Bunker Formula',
            'description' => 'Update Bunker Formula',
            'group' => 'bunker-formula',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_BUNKER_FORMULA,
            'label' => 'Delete Bunker Formula',
            'description' => 'Delete Bunker Formula',
            'group' => 'bunker-formula',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_BUNKER_JOURNALS,
            'label' => 'View Any Bunker Journals',
            'description' => 'View Any Bunker Journals',
            'group' => 'bunker-journal',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_BUNKER_JOURNALS,
            'label' => 'Delete Any Bunker Journals',
            'description' => 'Delete Any Bunker Journals',
            'group' => 'bunker-journal',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_BUNKER_JOURNAL,
            'label' => 'Create Bunker Journal',
            'description' => 'Create Bunker Journal',
            'group' => 'bunker-journal',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_BUNKER_JOURNAL,
            'label' => 'View Bunker Journal',
            'description' => 'View Bunker Journal',
            'group' => 'bunker-journal',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_BUNKER_JOURNAL,
            'label' => 'Update Bunker Journal',
            'description' => 'Update Bunker Journal',
            'group' => 'bunker-journal',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_BUNKER_JOURNAL,
            'label' => 'Delete Bunker Journal',
            'description' => 'Delete Bunker Journal',
            'group' => 'bunker-journal',
            'namespace' => self::NAMESPACE,
        ],

        [
            'name' => self::VIEW_ANY_OIL_JOURNALS,
            'label' => 'View Any Oil Journals',
            'description' => 'View Any Oil Journals',
            'group' => 'bunker-oil',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_ANY_OIL_JOURNALS,
            'label' => 'Delete Any Oil Journals',
            'description' => 'Delete Any Oil Journals',
            'group' => 'bunker-oil',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::CREATE_OIL_JOURNAL,
            'label' => 'Create Oil Journal',
            'description' => 'Create Oil Journal',
            'group' => 'bunker-oil',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::VIEW_OIL_JOURNAL,
            'label' => 'View Oil Journal',
            'description' => 'View Oil Journal',
            'group' => 'bunker-oil',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::UPDATE_OIL_JOURNAL,
            'label' => 'Update Oil Journal',
            'description' => 'Update Oil Journal',
            'group' => 'bunker-oil',
            'namespace' => self::NAMESPACE,
        ],
        [
            'name' => self::DELETE_OIL_JOURNAL,
            'label' => 'Delete Oil Journal',
            'description' => 'Delete Oil Journal',
            'group' => 'bunker-oil',
            'namespace' => self::NAMESPACE,
        ],
    ];

    public static function getPermissions(): array
    {
        return self::$permissions;
    }
}
