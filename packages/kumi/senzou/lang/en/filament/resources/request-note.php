<?php

use Kumi\Senzou\Support\Enums\RequestNoteStatus;

return [
    'fields' => [
        'date' => [
            'label' => 'Date',
        ],

        'location' => [
            'label' => 'Location',
        ],

        'voyage_number' => [
            'label' => 'Voyage No.',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],

        'delivery_requirement' => [
            'label' => 'Delivery Requirement',
        ],

        'number' => [
            'label' => 'No.',
        ],

        'item' => [
            'label' => 'Item (merk/type)',
        ],

        'quantity' => [
            'label' => 'Quantity',
        ],

        'stock_on_vessel' => [
            'label' => 'Vessel stock',
        ],

        'reason' => [
            'label' => 'Reason',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'status' => [
            'label' => 'Status',
        ],
    ],

    'columns' => [
        'id' => [
            'label' => 'Id',
        ],

        'date' => [
            'label' => 'Date',
        ],

        'location' => [
            'label' => 'Location',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],

        'voyage_number' => [
            'label' => 'Voyages No.',
        ],

        'delivery_requirement' => [
            'label' => 'Delivery Requirement',
        ],

        'status' => [
            'label' => 'Status',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'preview' => [
            'label' => 'Preview',
        ],

        'view' => [
            'label' => 'View',
        ],

        'edit' => [
            'label' => 'Edit',
        ],

        'delete' => [
            'label' => 'Delete',
        ],

        'approve' => [
            'label' => 'Approve',
        ],

        'reject' => [
            'label' => 'Reject',
        ],

        'status' => [
            'label' => 'Status',

            'options' => [
                RequestNoteStatus::PENDING => 'PENDING',
                RequestNoteStatus::APPROVED => 'APPROVED',
                RequestNoteStatus::REJECTED => 'REJECTED',
                RequestNoteStatus::IN_REVIEW => 'IN_REVIEW',
                RequestNoteStatus::FINALIZED => 'FINALIZED',
                RequestNoteStatus::DENIED => 'DENIED',
            ],
        ],
    ],

    'filters' => [
        'vessel' => [
            'label' => 'Vessel',
        ],
    ],

    'sub_titles' => [
        'dashboard' => [
            'label' => 'Dashboard',
        ],

        'create' => [
            'label' => 'Create',
        ],

        'view' => [
            'label' => 'View',
        ],

        'edit' => [
            'label' => 'Edit',
        ],
    ],

    'buttons' => [
        'add' => [
            'label' => 'New Request Note',
        ],

        'submit' => [
            'label' => 'Submit',
        ],

        'reset' => [
            'label' => 'Reset',
        ],
    ],

    'announced' => [
        'empty' => [
            'label' => 'There is no data here.',
        ],
    ],

    'actions' => [
        'approved' => [
            'label' => 'Approve',
        ],

        'rejected' => [
            'label' => 'Reject',
        ],

        'edit' => [
            'label' => 'Edit',
        ],

        'preview' => [
            'label' => 'Preview',
        ],

        'download' => [
            'label' => 'Download',
        ],

        'activate' => [
            'single' => [
                'label' => 'Activate',

                'modal' => [
                    'heading' => 'Activate :label',

                    'actions' => [
                        'activate' => [
                            'label' => 'Activate',
                        ],
                    ],
                ],

                'messages' => [
                    'activated' => 'Activated',
                ],
            ],
        ],
    ],
];
