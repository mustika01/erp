<?php

return [
    'columns' => [
        'started_at' => [
            'label' => 'Start Date',
        ],

        'finalized_at' => [
            'label' => 'Final Date',
        ],

        'deposit_amount' => [
            'label' => 'Deposit Amount (IDR)',
        ],

        'installment_amount' => [
            'label' => 'Installment Deposit Amount (IDR)',
        ],
    ],

    'fields' => [
        'started_at' => [
            'label' => 'Start Date',
        ],

        'finalized_at' => [
            'label' => 'Final Date',
        ],

        'deposit_amount' => [
            'label' => 'Deposit Amount (IDR)',
        ],

        'installment_amount' => [
            'label' => 'Installment Deposit Amount (IDR)',
        ],
    ],

    'events' => [
        'created' => 'A new deposit has been created.',
        'updated' => 'The deposit\'s details has been updated.',
        'deleted' => 'The deposit has been deleted.',

        'approved' => 'The deposit has been approved.',
    ],

    'actions' => [
        'approve' => [
            'single' => [
                'label' => 'Approve',

                'modal' => [
                    'heading' => 'Approve :label',

                    'actions' => [
                        'approve' => [
                            'label' => 'Approve',
                        ],
                    ],
                ],

                'messages' => [
                    'approved' => 'Approved',
                ],
            ],
        ],
    ],
];
