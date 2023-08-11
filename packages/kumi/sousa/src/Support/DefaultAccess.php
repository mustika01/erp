<?php

namespace Kumi\Sousa\Support;

use Kumi\Kanri\Support\DefaultRoles as KanriDefaultRoles;
use Kumi\Kyoka\Support\DefaultRoles as BaseDefaultRoles;

class DefaultAccess
{
    protected static array $access = [
        BaseDefaultRoles::ADMINISTRATOR => [
            DefaultPermissions::OVERVIEW_SOUSA,

            DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            DefaultPermissions::CREATE_VESSEL,
            DefaultPermissions::VIEW_VESSEL,
            DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            DefaultPermissions::VIEW_DESTINATION_CHARTS,

            DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            DefaultPermissions::CREATE_VESSEL_VOYAGE,
            DefaultPermissions::VIEW_VESSEL_VOYAGE,
            DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            DefaultPermissions::DELETE_VESSEL_VOYAGE,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            DefaultPermissions::UPDATE_VOYAGE_STATUS,
            DefaultPermissions::DELETE_VOYAGE_STATUS,

            DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            DefaultPermissions::CREATE_CARGO_LOG,
            DefaultPermissions::VIEW_CARGO_LOG,
            DefaultPermissions::UPDATE_CARGO_LOG,
            DefaultPermissions::DELETE_CARGO_LOG,

            DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            DefaultPermissions::CREATE_BUNKER,
            DefaultPermissions::VIEW_BUNKER,
            DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            DefaultPermissions::CREATE_BUNKER_FORMULA,
            DefaultPermissions::VIEW_BUNKER_FORMULA,
            DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            DefaultPermissions::CREATE_BUNKER_JOURNAL,
            DefaultPermissions::VIEW_BUNKER_JOURNAL,
            DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            DefaultPermissions::DELETE_BUNKER_JOURNAL,

            DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            DefaultPermissions::CREATE_OIL_JOURNAL,
            DefaultPermissions::VIEW_OIL_JOURNAL,
            DefaultPermissions::UPDATE_OIL_JOURNAL,
            DefaultPermissions::DELETE_OIL_JOURNAL,

            DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        KanriDefaultRoles::MANAGING_DIRECTOR => [
            DefaultPermissions::OVERVIEW_SOUSA,

            DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            // DefaultPermissions::CREATE_VESSEL,
            DefaultPermissions::VIEW_VESSEL,
            // DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            DefaultPermissions::VIEW_DESTINATION_CHARTS,

            DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            // DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE,
            DefaultPermissions::VIEW_VESSEL_VOYAGE,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            // DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            // DefaultPermissions::UPDATE_VOYAGE_STATUS,
            // DefaultPermissions::DELETE_VOYAGE_STATUS,

            // DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            // DefaultPermissions::CREATE_CARGO_LOG,
            // DefaultPermissions::VIEW_CARGO_LOG,
            // DefaultPermissions::UPDATE_CARGO_LOG,
            // DefaultPermissions::DELETE_CARGO_LOG,

            DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            // DefaultPermissions::CREATE_BUNKER,
            DefaultPermissions::VIEW_BUNKER,
            // DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::CREATE_BUNKER_FORMULA,
            DefaultPermissions::VIEW_BUNKER_FORMULA,
            // DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::CREATE_BUNKER_JOURNAL,
            DefaultPermissions::VIEW_BUNKER_JOURNAL,
            // DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            // DefaultPermissions::DELETE_BUNKER_JOURNAL,

            DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            // DefaultPermissions::CREATE_OIL_JOURNAL,
            DefaultPermissions::VIEW_OIL_JOURNAL,
            // DefaultPermissions::UPDATE_OIL_JOURNAL,
            // DefaultPermissions::DELETE_OIL_JOURNAL,

            // DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        KanriDefaultRoles::VICE_MANAGING_DIRECTOR => [
            DefaultPermissions::OVERVIEW_SOUSA,

            DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            // DefaultPermissions::CREATE_VESSEL,
            DefaultPermissions::VIEW_VESSEL,
            // DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            DefaultPermissions::VIEW_DESTINATION_CHARTS,

            DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            // DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE,
            DefaultPermissions::VIEW_VESSEL_VOYAGE,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            // DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            // DefaultPermissions::UPDATE_VOYAGE_STATUS,
            // DefaultPermissions::DELETE_VOYAGE_STATUS,

            // DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            // DefaultPermissions::CREATE_CARGO_LOG,
            // DefaultPermissions::VIEW_CARGO_LOG,
            // DefaultPermissions::UPDATE_CARGO_LOG,
            // DefaultPermissions::DELETE_CARGO_LOG,

            DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            // DefaultPermissions::CREATE_BUNKER,
            DefaultPermissions::VIEW_BUNKER,
            // DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::CREATE_BUNKER_FORMULA,
            DefaultPermissions::VIEW_BUNKER_FORMULA,
            // DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::CREATE_BUNKER_JOURNAL,
            DefaultPermissions::VIEW_BUNKER_JOURNAL,
            // DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            // DefaultPermissions::DELETE_BUNKER_JOURNAL,

            DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            // DefaultPermissions::CREATE_OIL_JOURNAL,
            DefaultPermissions::VIEW_OIL_JOURNAL,
            // DefaultPermissions::UPDATE_OIL_JOURNAL,
            // DefaultPermissions::DELETE_OIL_JOURNAL,

            // DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        DefaultRoles::OPERATIONAL_MANAGER => [
            DefaultPermissions::OVERVIEW_SOUSA,

            DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            DefaultPermissions::CREATE_VESSEL,
            DefaultPermissions::VIEW_VESSEL,
            DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            DefaultPermissions::VIEW_DESTINATION_CHARTS,

            // DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            DefaultPermissions::CREATE_VESSEL_VOYAGE,
            DefaultPermissions::VIEW_VESSEL_VOYAGE,
            DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            DefaultPermissions::DELETE_VESSEL_VOYAGE,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            DefaultPermissions::UPDATE_VOYAGE_STATUS,
            DefaultPermissions::DELETE_VOYAGE_STATUS,

            DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            DefaultPermissions::CREATE_CARGO_LOG,
            DefaultPermissions::VIEW_CARGO_LOG,
            DefaultPermissions::UPDATE_CARGO_LOG,
            DefaultPermissions::DELETE_CARGO_LOG,

            DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            DefaultPermissions::CREATE_BUNKER,
            DefaultPermissions::VIEW_BUNKER,
            DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            DefaultPermissions::CREATE_BUNKER_FORMULA,
            DefaultPermissions::VIEW_BUNKER_FORMULA,
            DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            DefaultPermissions::CREATE_BUNKER_JOURNAL,
            DefaultPermissions::VIEW_BUNKER_JOURNAL,
            DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            DefaultPermissions::DELETE_BUNKER_JOURNAL,

            DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            DefaultPermissions::CREATE_OIL_JOURNAL,
            DefaultPermissions::VIEW_OIL_JOURNAL,
            DefaultPermissions::UPDATE_OIL_JOURNAL,
            DefaultPermissions::DELETE_OIL_JOURNAL,

            DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        DefaultRoles::OPERATIONAL_ASSISTANT => [
            DefaultPermissions::OVERVIEW_SOUSA,

            DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            DefaultPermissions::CREATE_VESSEL,
            DefaultPermissions::VIEW_VESSEL,
            DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            DefaultPermissions::VIEW_DESTINATION_CHARTS,

            // DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            // DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            DefaultPermissions::CREATE_VESSEL_VOYAGE,
            DefaultPermissions::VIEW_VESSEL_VOYAGE,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            DefaultPermissions::UPDATE_VOYAGE_STATUS,
            // DefaultPermissions::DELETE_VOYAGE_STATUS,

            DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            DefaultPermissions::CREATE_CARGO_LOG,
            DefaultPermissions::VIEW_CARGO_LOG,
            DefaultPermissions::UPDATE_CARGO_LOG,
            // DefaultPermissions::DELETE_CARGO_LOG,

            DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            // DefaultPermissions::CREATE_BUNKER,
            DefaultPermissions::VIEW_BUNKER,
            // DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::CREATE_BUNKER_FORMULA,
            DefaultPermissions::VIEW_BUNKER_FORMULA,
            // DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::CREATE_BUNKER_JOURNAL,
            DefaultPermissions::VIEW_BUNKER_JOURNAL,
            // DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            // DefaultPermissions::DELETE_BUNKER_JOURNAL,

            DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            // DefaultPermissions::CREATE_OIL_JOURNAL,
            DefaultPermissions::VIEW_OIL_JOURNAL,
            // DefaultPermissions::UPDATE_OIL_JOURNAL,
            // DefaultPermissions::DELETE_OIL_JOURNAL,

            DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        DefaultRoles::OPERATIONAL_DOCUMENT_USER => [
            DefaultPermissions::OVERVIEW_SOUSA,

            DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            DefaultPermissions::CREATE_VESSEL,
            DefaultPermissions::VIEW_VESSEL,
            DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            // DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            // DefaultPermissions::VIEW_DESTINATION_CHARTS,

            // DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            // DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE,
            DefaultPermissions::VIEW_VESSEL_VOYAGE,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            // DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            // DefaultPermissions::UPDATE_VOYAGE_STATUS,
            // DefaultPermissions::DELETE_VOYAGE_STATUS,

            DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            // DefaultPermissions::CREATE_CARGO_LOG,
            DefaultPermissions::VIEW_CARGO_LOG,
            // DefaultPermissions::UPDATE_CARGO_LOG,
            // DefaultPermissions::DELETE_CARGO_LOG,

            // DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            // DefaultPermissions::CREATE_BUNKER,
            // DefaultPermissions::VIEW_BUNKER,
            // DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            // DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::CREATE_BUNKER_FORMULA,
            // DefaultPermissions::VIEW_BUNKER_FORMULA,
            // DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            // DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::CREATE_BUNKER_JOURNAL,
            // DefaultPermissions::VIEW_BUNKER_JOURNAL,
            // DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            // DefaultPermissions::DELETE_BUNKER_JOURNAL,

            // DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            // DefaultPermissions::CREATE_OIL_JOURNAL,
            // DefaultPermissions::VIEW_OIL_JOURNAL,
            // DefaultPermissions::UPDATE_OIL_JOURNAL,
            // DefaultPermissions::DELETE_OIL_JOURNAL,

            // DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        DefaultRoles::OPERATIONAL_MONITORING_USER => [
            DefaultPermissions::OVERVIEW_SOUSA,

            DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            // DefaultPermissions::CREATE_VESSEL,
            DefaultPermissions::VIEW_VESSEL,
            // DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            // DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            // DefaultPermissions::VIEW_DESTINATION_CHARTS,

            // DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            // DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            // DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            // DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            // DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            DefaultPermissions::CREATE_VESSEL_VOYAGE,
            DefaultPermissions::VIEW_VESSEL_VOYAGE,
            DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            DefaultPermissions::UPDATE_VOYAGE_STATUS,
            // DefaultPermissions::DELETE_VOYAGE_STATUS,

            DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            DefaultPermissions::CREATE_CARGO_LOG,
            DefaultPermissions::VIEW_CARGO_LOG,
            // DefaultPermissions::UPDATE_CARGO_LOG,
            // DefaultPermissions::DELETE_CARGO_LOG,

            // DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            // DefaultPermissions::CREATE_BUNKER,
            // DefaultPermissions::VIEW_BUNKER,
            // DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            // DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::CREATE_BUNKER_FORMULA,
            // DefaultPermissions::VIEW_BUNKER_FORMULA,
            // DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            // DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::CREATE_BUNKER_JOURNAL,
            // DefaultPermissions::VIEW_BUNKER_JOURNAL,
            // DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            // DefaultPermissions::DELETE_BUNKER_JOURNAL,

            // DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            // DefaultPermissions::CREATE_OIL_JOURNAL,
            // DefaultPermissions::VIEW_OIL_JOURNAL,
            // DefaultPermissions::UPDATE_OIL_JOURNAL,
            // DefaultPermissions::DELETE_OIL_JOURNAL,

            DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        DefaultRoles::OPERATIONAL_BUNKER_USER => [
            // DefaultPermissions::OVERVIEW_SOUSA,

            // DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            // DefaultPermissions::CREATE_VESSEL,
            // DefaultPermissions::VIEW_VESSEL,
            // DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            // DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            // DefaultPermissions::VIEW_DESTINATION_CHARTS,

            // DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            // DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            // DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            // DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            // DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            // DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            // DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            // DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            // DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            // DefaultPermissions::UPDATE_VOYAGE_STATUS,
            // DefaultPermissions::DELETE_VOYAGE_STATUS,

            // DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            // DefaultPermissions::CREATE_CARGO_LOG,
            // DefaultPermissions::VIEW_CARGO_LOG,
            // DefaultPermissions::UPDATE_CARGO_LOG,
            // DefaultPermissions::DELETE_CARGO_LOG,

            DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            DefaultPermissions::CREATE_BUNKER,
            DefaultPermissions::VIEW_BUNKER,
            DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            DefaultPermissions::CREATE_BUNKER_FORMULA,
            DefaultPermissions::VIEW_BUNKER_FORMULA,
            DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            DefaultPermissions::CREATE_BUNKER_JOURNAL,
            DefaultPermissions::VIEW_BUNKER_JOURNAL,
            DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            DefaultPermissions::DELETE_BUNKER_JOURNAL,

            DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            DefaultPermissions::CREATE_OIL_JOURNAL,
            DefaultPermissions::VIEW_OIL_JOURNAL,
            DefaultPermissions::UPDATE_OIL_JOURNAL,
            DefaultPermissions::DELETE_OIL_JOURNAL,

            // DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],

        DefaultRoles::OPERATIONAL_USER => [
            // DefaultPermissions::OVERVIEW_SOUSA,

            // DefaultPermissions::VIEW_ANY_VESSELS,
            // DefaultPermissions::DELETE_ANY_VESSELS,
            // DefaultPermissions::CREATE_VESSEL,
            // DefaultPermissions::VIEW_VESSEL,
            // DefaultPermissions::UPDATE_VESSEL,
            // DefaultPermissions::DELETE_VESSEL,

            // DefaultPermissions::VIEW_VESSEL_DASHBOARD,
            // DefaultPermissions::VIEW_DESTINATION_CHARTS,

            // DefaultPermissions::PREVIEW_VESSEL_SHIP_PARTICULARS,
            // DefaultPermissions::DOWNLOAD_VESSEL_SHIP_PARTICULARS,

            // DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS,
            // DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS,

            // DefaultPermissions::VIEW_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::DELETE_ANY_VESSEL_DOCUMENTS,
            // DefaultPermissions::CREATE_VESSEL_DOCUMENT,
            // DefaultPermissions::VIEW_VESSEL_DOCUMENT,
            // DefaultPermissions::UPDATE_VESSEL_DOCUMENT,
            // DefaultPermissions::DELETE_VESSEL_DOCUMENT,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE,

            // DefaultPermissions::VIEW_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::DELETE_ANY_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::CREATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::UPDATE_VESSEL_VOYAGE_ACTIVITY,
            // DefaultPermissions::DELETE_VESSEL_VOYAGE_ACTIVITY,

            // DefaultPermissions::VIEW_RECENT_VESSEL_VOYAGE_ACTIVITIES,
            // DefaultPermissions::VIEW_VESSEL_VOYAGE_ACTIVITY_DETAILS,

            // DefaultPermissions::VIEW_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::DELETE_ANY_VOYAGE_STATUSES,
            // DefaultPermissions::CREATE_VOYAGE_STATUS,
            // DefaultPermissions::VIEW_VOYAGE_STATUS,
            // DefaultPermissions::UPDATE_VOYAGE_STATUS,
            // DefaultPermissions::DELETE_VOYAGE_STATUS,

            // DefaultPermissions::VIEW_ANY_CARGO_LOGS,
            // DefaultPermissions::DELETE_ANY_CARGO_LOGS,
            // DefaultPermissions::CREATE_CARGO_LOG,
            // DefaultPermissions::VIEW_CARGO_LOG,
            // DefaultPermissions::UPDATE_CARGO_LOG,
            // DefaultPermissions::DELETE_CARGO_LOG,

            // DefaultPermissions::VIEW_ANY_BUNKERS,
            // DefaultPermissions::DELETE_ANY_BUNKERS,
            // DefaultPermissions::CREATE_BUNKER,
            // DefaultPermissions::VIEW_BUNKER,
            // DefaultPermissions::UPDATE_BUNKER,
            // DefaultPermissions::DELETE_BUNKER,

            // DefaultPermissions::VIEW_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::DELETE_ANY_BUNKER_FORMULAS,
            // DefaultPermissions::CREATE_BUNKER_FORMULA,
            // DefaultPermissions::VIEW_BUNKER_FORMULA,
            // DefaultPermissions::UPDATE_BUNKER_FORMULA,
            // DefaultPermissions::DELETE_BUNKER_FORMULA,

            // DefaultPermissions::VIEW_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::DELETE_ANY_BUNKER_JOURNALS,
            // DefaultPermissions::CREATE_BUNKER_JOURNAL,
            // DefaultPermissions::VIEW_BUNKER_JOURNAL,
            // DefaultPermissions::UPDATE_BUNKER_JOURNAL,
            // DefaultPermissions::DELETE_BUNKER_JOURNAL,

            // DefaultPermissions::VIEW_ANY_OIL_JOURNALS,
            // DefaultPermissions::DELETE_ANY_OIL_JOURNALS,
            // DefaultPermissions::CREATE_OIL_JOURNAL,
            // DefaultPermissions::VIEW_OIL_JOURNAL,
            // DefaultPermissions::UPDATE_OIL_JOURNAL,
            // DefaultPermissions::DELETE_OIL_JOURNAL,

            // DefaultPermissions::DOWNLOAD_STATUSES_VOYAGE,
        ],
    ];

    public static function getAccess(): array
    {
        return self::$access;
    }
}
