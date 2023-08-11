<?php

use Kumi\Sousa\Support\Enums\VesselType;
use Kumi\Sousa\Support\Enums\VesselStatus;
use Kumi\Sousa\Support\Enums\VesselClassification;

return [

    'columns' => [

        'name' => [
            'label' => 'Name',
        ],

        'year_built' => [
            'label' => 'Year',
        ],

        'length' => [
            'label' => 'Length',
        ],

        'breadth' => [
            'label' => 'Breadth',
        ],

        'depth' => [
            'label' => 'Depth',
        ],

        'draft' => [
            'label' => 'Draft',
        ],

        'last_docked_at' => [
            'label' => 'Last Docking Date',
        ],

    ],

    'sections' => [

        'basic-details' => 'Basic Details',
        'construction-and-status' => 'Construction & Status',
        'engine-and-other-details' => 'Engine & Other Details',
        'dimension' => 'Dimension',
        'tonnage' => 'Tonnage',

    ],

    'fields' => [

        'name' => [
            'label' => 'Name',
        ],

        'registration_number' => [
            'label' => 'Registration No.',
        ],

        'vessel_type' => [
            'label' => 'Vessel Type',

            'options' => [
                VesselType::MOTOR_VESSEL => 'Motor Vessel',
                VesselType::TUG_BOAT => 'Tug Boat',
                VesselType::BARGE => 'Barge',
                VesselType::TANKER => 'Tanker',
            ],
        ],

        'imo_number' => [
            'label' => 'IMO No.',
        ],

        'registration_port' => [
            'label' => 'Registration Port',
        ],

        'call_sign' => [
            'label' => 'Call Sign',
        ],

        'flag_nationality' => [
            'label' => 'Flag Nationality',
        ],

        'classification' => [
            'label' => 'Classification',

            'options' => [
                VesselClassification::BKI => 'BKI',
            ],
        ],

        'status' => [
            'label' => 'Status',

            'options' => [
                VesselStatus::OPERATIONAL => 'Operational',
                VesselStatus::SOLD => 'Sold',
                VesselStatus::SCRAPPED => 'Scrapped',
            ],
        ],

        'year_built' => [
            'label' => 'Year Built',
        ],

        'builder_name' => [
            'label' => 'Builder',
        ],

        'hull_material' => [
            'label' => 'Hull Material',
        ],

        'main_engine' => [
            'label' => 'Main Engine',
        ],

        'aux_engine' => [
            'label' => 'Auxiliary Engine',
        ],

        'crane_description' => [
            'label' => 'Crane Description',
        ],

        // 'crane_count' => [
        //     'label' => 'No. of Cranes',
        // ],

        'average_cruise_speed' => [
            'label' => 'Average Cruise Speed',
        ],

        'featured_image' => [
            'label' => 'Featured Image',
        ],

        'length' => [
            'label' => 'Length',
        ],

        'breadth' => [
            'label' => 'Breadth',
        ],

        'depth' => [
            'label' => 'Depth',
        ],

        'draft' => [
            'label' => 'Draft',
        ],

        'last_docked_at' => [
            'label' => 'Last Docking Date',
        ],

        'next_docked_at' => [
            'label' => 'Next Docking Date',
        ],

        'gross_tonnage' => [
            'label' => 'Gross Tonnage (GT)',
        ],

        'nett_tonnage' => [
            'label' => 'Nett Tonnage (NT)',
        ],

        'dead_weight_tonnage' => [
            'label' => 'Dead Weight Tonnage (DWT)',
        ],

    ],

    'filters' => [

        'status' => [
            'label' => 'Status',

            'options' => [
                VesselStatus::OPERATIONAL => 'Operational',
                VesselStatus::SOLD => 'Sold',
                VesselStatus::SCRAPPED => 'Scrapped',
            ],
        ],

    ],

    'events' => [

        'created' => 'A new vessel has been created.',
        'updated' => 'The vessel\'s details has been updated.',
        'deleted' => 'The vessel has been deleted.',

    ],

    'actions' => [

        'preview-ship-particulars' => [
            'label' => 'Preview SP',
        ],

        'download-ship-particulars' => [
            'label' => 'Download SP',
        ],

        'dashboard' => [
            'label' => 'Dashboard',
        ],

    ],

];
