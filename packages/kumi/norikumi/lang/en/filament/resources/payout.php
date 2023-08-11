<?php

return [
    'columns' => [
        'name_position' => [
            'label' => 'Name / Position',
        ],

        'description' => [
            'label' => 'Description',
        ],

        'job_position' => [
            'label' => 'Position',
        ],

        'finalized_at' => [
            'label' => 'Final Date',
        ],

        'amount' => [
            'label' => 'Amount (IDR)',
        ],

        'base_amount' => [
            'label' => 'Base (IDR)',
        ],

        'loan_amount' => [
            'label' => 'Loan. (IDR)',
        ],

        'adjustment_amount' => [
            'label' => 'Adj. (IDR)',
        ],

        'take_home_pay_amount' => [
            'label' => 'THP (IDR)',
        ],

        'primary_bank_name' => [
            'label' => 'Bank',
        ],

        'primary_bank_account_number' => [
            'label' => 'Acc No.',
        ],

        'salary_grade' => [
            'label' => 'Salary Grade',
        ],

        'approvals' => [
            'label' => 'Approvals',
        ],
    ],

    'events' => [
        'created' => 'A new payout has been created.',
        'updated' => 'The payout\'s details has been updated.',
        'deleted' => 'The payout has been deleted.',

        'approved' => 'The payout has been approved.',
    ],

    'headings' => [
        'gross_payout' => 'Gross Payout (IDR)',
        'take_home_pay' => 'Take Home Pay (IDR)',
    ],

    'filters' => [
        'vessel' => [
            'label' => 'Vessel',
        ],
    ],

    'actions' => [
        'approve' => [
            'multiple' => [
                'label' => 'Approve selected',

                'modal' => [
                    'heading' => 'Approve selected :label',

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

        'disburse' => [
            'multiple' => [
                'label' => 'Disburse selected',

                'modal' => [
                    'heading' => 'Disburse selected :label',

                    'actions' => [
                        'disburse' => [
                            'label' => 'Disburse',
                        ],
                    ],
                ],

                'messages' => [
                    'disbursed' => 'Disbursed',
                ],
            ],

            'single' => [
                'label' => 'Disburse',

                'modal' => [
                    'heading' => 'Disburse :label',

                    'actions' => [
                        'disburse' => [
                            'label' => 'Disburse',
                        ],
                    ],
                ],

                'messages' => [
                    'disbursed' => 'Disbursed',
                ],
            ],
        ],
    ],
];
