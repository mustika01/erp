<?php

use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;

return [
    'forms' => [
        'voyage_status' => [
            'label' => 'Voyage Status',

            'options' => [
                VoyageState::START_LOADING => 'Start Loading',
                VoyageState::FINISH_UNLOADING => 'Finish Unloading',
            ],
        ],

        'started_at' => [
            'label' => 'Start Date',
        ],

        'ended_at' => [
            'label' => 'End Date',
        ],
    ],
];
