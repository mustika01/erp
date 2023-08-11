<?php

use Kumi\Senzou\Support\Enums\DeliveryNoteEntryRemarks;

return [
    'columns' => [
        'date' => [
            'label' => 'Date',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'status' => [
            'label' => 'Status',

            'states' => [
                'committed' => 'Committed',
                'draft' => 'Draft',
            ],
        ],

        'item' => [
            'label' => 'Item',
        ],

        'quantity' => [
            'label' => 'Quantity',
        ],

        'remarks' => [
            'label' => 'Remarks',

            'options' => [
                DeliveryNoteEntryRemarks::DECK => 'Deck',
                DeliveryNoteEntryRemarks::ENGINE => 'Engine',
            ],
        ],
    ],

    'fields' => [
        'date' => [
            'label' => 'Date',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'quantity' => [
            'label' => 'Quantity',
        ],

        'status' => [
            'label' => 'Status',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'remarks' => [
            'label' => 'Remarks',

            'options' => [
                DeliveryNoteEntryRemarks::DECK => 'Deck',
                DeliveryNoteEntryRemarks::ENGINE => 'Engine',
            ],
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

        'preview-dn-daily-report' => [
            'label' => 'Preview DN Daily Report',
        ],

        'download-dn-daily-report' => [
            'label' => 'Download DN Daily Report',
        ],

        'preview-delivery-notes' => [
            'label' => 'Preview',
        ],

        'download-delivery-notes' => [
            'label' => 'Download',
        ],
    ],

    'headings' => [
        'daily-report' => 'DN Daily Report',
    ],
];
