<?php

return [
    'fields' => [
        'bunker_id' => [
            'label' => 'Bunker',
        ],

        'date' => [
            'label' => 'Date',
        ],

        'description' => [
            'label' => 'Description',
        ],

        'rob_amount' => [
            'label' => 'R.O.B',
        ],

        'remainder' => [
            'label' => 'Remainder',
        ],

        'total_usage' => [
            'label' => 'Total Usage',
        ],
    ],

    'columns' => [
        'vessel' => [
            'label' => 'Vessel',
        ],

        'date' => [
            'label' => 'Date',
        ],

        'rob_amount_formatted' => [
            'label' => 'R.O.B',
        ],

        'remainder_formatted' => [
            'label' => 'Remainder',
        ],

        'real_time_usage_formatted' => [
            'label' => 'Usage',
        ],

        'status' => [
            'label' => 'Status',

            'states' => [
                'committed' => 'Committed',
                'draft' => 'Draft',
            ],
        ],
    ],

    'filters' => [
        'bunker_id' => [
            'label' => 'Vessel',
        ],
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
