<?php

use Kumi\Norikumi\Support\Enums\DisbursementStatus;

return [
    'columns' => [
        'bank_name' => [
            'label' => 'Bank Name',
        ],

        'account_number' => [
            'label' => 'Account No.',
        ],

        'account_name' => [
            'label' => 'Account Name',
        ],

        'amount' => [
            'label' => 'Amount (IDR)',
        ],

        'status' => [
            'label' => 'Status',

            'options' => [
                DisbursementStatus::PENDING => 'PENDING',
                DisbursementStatus::PROCESSING => 'PROCESSING',
                DisbursementStatus::FAILED => 'FAILED',
                DisbursementStatus::COMPLETED => 'COMPLETED',
            ],
        ],
    ],
];
