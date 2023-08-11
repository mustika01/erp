<?php

return [
    'fields' => [
        'reportable_type' => [
            'label' => 'Type',

            'options' => [
                \Kumi\Jinzai\Models\Payout::class => 'Payout',
                \Kumi\Sousa\Models\VesselVoyage::class => 'Voyage Summary',
                'docking-schedule' => 'Docking Schedule',
            ],
        ],
    ],

    'columns' => [
        'reportable_type' => [
            'label' => 'Type',

            'options' => [
                \Kumi\Jinzai\Models\Payout::class => 'Payout',
                \Kumi\Sousa\Models\VesselVoyage::class => 'Voyage Summary',
                'docking-schedule' => 'Docking Schedule',
            ],
        ],

        'start_date' => [
            'label' => 'Start Date',
        ],

        'final_date' => [
            'label' => 'Final Date',
        ],

        'owner' => [
            'label' => 'Owner',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'download' => [
            'label' => 'Download',
        ],
    ],
];
