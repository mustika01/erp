<?php

use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;

return [
    'columns' => [
        'origin_nor' => [
            'label' => 'Origin Nor',
        ],

        'origin_sof' => [
            'label' => 'Origin SOF',
        ],

        'origin_spb' => [
            'label' => 'Origin SPB',
        ],

        'origin_report' => [
            'label' => 'Origin Report',
        ],

        'destination_nor' => [
            'label' => 'Destination Nor',
        ],

        'destination_sof' => [
            'label' => 'Destination SOF',
        ],

        'destination_spb' => [
            'label' => 'Destination SPB',
        ],

        'destination_report' => [
            'label' => 'Destination Report',
        ],

        'upload_file_origin' => [
            'label' => 'Upload File Origin',
        ],

        'upload_file_destination' => [
            'label' => 'Upload File Destination',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'cargo_content' => [
            'label' => 'Cargo',
        ],

        'number' => [
            'label' => 'Voy. No.',
        ],

        'origin' => [
            'label' => 'Origin',
        ],

        'departed_at' => [
            'label' => 'Depart',
        ],

        'destination' => [
            'label' => 'Destination',
        ],

        'arrived_at' => [
            'label' => 'Arrive',
        ],

        'status' => [
            'label' => 'Status',

            'options' => [
                VoyageState::WAITING_FOR_INSTRUCTIONS => 'Waiting For Instructions',
                VoyageState::WAITING_FOR_DEPARTURE => 'Waiting For Departure',
                VoyageState::START_LOADING => 'Start Loading',
                VoyageState::FINISH_LOADING => 'Finish Loading',
                VoyageState::UNMOORED => 'Unmoored',
                VoyageState::DEPARTED => 'Departed',
                VoyageState::ARRIVED => 'Arrived',
                VoyageState::MOORED => 'Moored',
                VoyageState::START_UNLOADING => 'Start Unloading',
                VoyageState::FINISH_UNLOADING => 'Finish Unloading',
                VoyageState::CONDITIONAL_DEPARTURE => 'Conditional Departure',
                VoyageState::CONDITIONAL_ARRIVAL => 'Conditional Arrival',
            ],
        ],
    ],

    'fields' => [
        'origin_nor' => [
            'label' => 'Origin NOR',
        ],

        'origin_sof' => [
            'label' => 'Origin SOF',
        ],

        'origin_spb' => [
            'label' => 'Origin SPB',
        ],

        'origin_report' => [
            'label' => 'Origin Report',
        ],

        'destination_nor' => [
            'label' => 'Destination NOR',
        ],

        'destination_sof' => [
            'label' => 'Destination SOF',
        ],

        'destination_spb' => [
            'label' => 'Destination SPB',
        ],

        'destination_report' => [
            'label' => 'Destination Report',
        ],

        'upload_file_origin' => [
            'label' => 'Upload File Origin',
        ],

        'upload_file_destination' => [
            'label' => 'Upload File Destination',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'number' => [
            'label' => 'Voy. No.',
        ],

        'is_returning' => [
            'label' => 'Return Voyage?',
        ],

        'cargo_content' => [
            'label' => 'Cargo Content',
        ],

        'origin_city' => [
            'label' => 'Origin City',

            'modal' => [
                'fields' => [
                    'name' => [
                        'label' => 'Name',
                    ],
                ],
            ],
        ],

        'origin_port' => [
            'label' => 'Origin Port',

            'modal' => [
                'fields' => [
                    'city_id' => [
                        'label' => 'City',
                    ],

                    'name' => [
                        'label' => 'Name',
                    ],
                ],
            ],
        ],

        'destination_city' => [
            'label' => 'Destination City',

            'modal' => [
                'fields' => [
                    'name' => [
                        'label' => 'Name',
                    ],
                ],
            ],
        ],

        'destination_port' => [
            'label' => 'Destination Port',

            'modal' => [
                'fields' => [
                    'city_id' => [
                        'label' => 'City',
                    ],

                    'name' => [
                        'label' => 'Name',
                    ],
                ],
            ],
        ],
    ],

    'filters' => [
        'vessel_id' => [
            'label' => 'Vessel',
        ],

        'is_returning' => [
            'label' => 'Return Voyage?',
        ],
    ],

    'events' => [
        'created' => 'A new voyage has been created.',
        'updated' => 'The voyage\'s details has been updated.',
        'deleted' => 'The voyage has been deleted.',
    ],

    'calendar' => [
        'loading' => 'LU :tonnage_amount t',
        'unloading' => 'UL :tonnage_amount t',
    ],

    'actions' => [
        'commit' => [
            'label' => 'Commit',

            'single' => [
                'modal' => [
                    'heading' => 'Commit :label',
                ],
            ],
        ],
    ],
];
