<?php

return [
    'fields' => [
        'vessel' => [
            'label' => 'Vessel',
        ],

        'rob_amount' => [
            'label' => 'R.O.B',
        ],

        'engines' => [
            'label' => 'Engines',
        ],
    ],

    'columns' => [
        'vessel' => [
            'label' => 'Vessel',
        ],

        'latest_journal_date' => [
            'label' => 'Latest Journal Date',
        ],

        'rob_amount_formatted' => [
            'label' => 'Solar',
        ],

        'type_90_amount_formatted' => [
            'label' => 'T.90',
        ],

        'type_40_amount_formatted' => [
            'label' => 'T.40',
        ],

        'type_10_amount_formatted' => [
            'label' => 'T.10',
        ],

        'is_finalized' => [
            'label' => 'Finalized',
        ],
    ],

    'actions' => [
        'solar' => [
            'label' => 'Solar',
        ],

        'oil' => [
            'label' => 'Oil',
        ],
    ],

    'events' => [
        'created' => 'A new bunker has been created.',
        'updated' => 'The bunker\'s details has been updated.',
        'deleted' => 'The bunker has been deleted.',
    ],
];
