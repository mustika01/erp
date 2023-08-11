<?php

use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;

return [
    'fields' => [
        'description' => [
            'label' => 'Description',

            'options' => [
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

        'executed_at' => [
            'label' => 'Date & Time',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],
    ],

    'columns' => [
        'description' => [
            'label' => 'Description',

            'options' => [
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

        'executed_date' => [
            'label' => 'Date',
        ],

        'executed_time' => [
            'label' => 'Time',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],
    ],

    'actions' => [
        'preview' => [
            'label' => 'Preview',
        ],

        'download' => [
            'label' => 'Download',
        ],

        'title' => [
            'label' => 'Statuses Voyage',
        ],
    ],
];
