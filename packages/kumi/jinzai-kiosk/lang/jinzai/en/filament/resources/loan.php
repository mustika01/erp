<?php

return [

    'columns' => [

        'started_at' => [
            'label' => 'Start Date',
        ],

        'finalized_at' => [
            'label' => 'Final Date',
        ],

        'loan_amount' => [
            'label' => 'Loan Amount (IDR)',
        ],

        'installment_amount' => [
            'label' => 'Installment Amount (IDR)',
        ],

        'status' => [
            'label' => 'Status',

            'options' => [

                'approved' => 'APPROVED',
                'pending' => 'PENDING',

            ],
        ],

    ],

    'fields' => [

        'started_at' => [
            'label' => 'Start Date',
        ],

        'finalized_at' => [
            'label' => 'Final Date',
        ],

        'loan_amount' => [
            'label' => 'Loan Amount (IDR)',
        ],

        'installment_amount' => [
            'label' => 'Installment Amount (IDR)',
        ],

    ],

    'events' => [

        'created' => 'A new loan has been created.',
        'updated' => 'The loan\'s details has been updated.',
        'deleted' => 'The loan has been deleted.',

        'approved' => 'The loan has been approved.',

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
