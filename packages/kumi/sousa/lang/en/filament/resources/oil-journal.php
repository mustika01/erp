<?php

use Kumi\Sousa\Support\Enums\OilJournalEntryType;
use Kumi\Sousa\Support\Enums\OilJournalOilType;

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

        'rob_amount_type_90' => [
            'label' => 'R.O.B Type 90',
        ],

        'remainder_type_90' => [
            'label' => 'Remainder Type 90',
        ],

        'total_usage_type_90' => [
            'label' => 'Total Usage Type 90',
        ],

        'rob_amount_type_40' => [
            'label' => 'R.O.B Type 40',
        ],

        'remainder_type_40' => [
            'label' => 'Remainder Type 40',
        ],

        'total_usage_type_40' => [
            'label' => 'Total Usage Type 40',
        ],

        'rob_amount_type_10' => [
            'label' => 'R.O.B Type 10',
        ],

        'remainder_type_10' => [
            'label' => 'Remainder Type 10',
        ],

        'total_usage_type_10' => [
            'label' => 'Total Usage Type 10',
        ],

        'oil_type' => [
            'options' => [
                OilJournalOilType::TYPE_90 => 'Type 90',
                OilJournalOilType::TYPE_40 => 'Type 40',
                OilJournalOilType::TYPE_10 => 'Type 10',
            ],
        ],
        'entry_type' => [
            'options' => [
                OilJournalEntryType::USAGE => 'Usage',
                OilJournalEntryType::REFUEL => 'Re-Fuel',
            ],
        ],
    ],

    'columns' => [
        'vessel' => [
            'label' => 'Vessel',
        ],

        'date' => [
            'label' => 'Date',
        ],

        'rob_90' => [
            'label' => 'R.O.B 90',
        ],

        'rob_40' => [
            'label' => 'R.O.B 40',
        ],

        'rob_10' => [
            'label' => 'R.O.B 10',
        ],

        'usage_90' => [
            'label' => 'Usage 90',
        ],

        'usage_40' => [
            'label' => 'Usage 40',
        ],

        'usage_10' => [
            'label' => 'Usage 10',
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
