<?php

use Kumi\Kiosk\Support\Enums\PayoutStatus;

return [

    'fields' => [

        'description' => [
            'label' => 'Description',
        ],

        'started_at' => [
            'label' => 'Start Date',
        ],

        'finalized_at' => [
            'label' => 'Final Date',
        ],

        'status' => [
            'label' => 'Status',
        ],

    ],

    'columns' => [

        'finalized_at' => [
            'label' => 'Month',
        ],

        'amount' => [
            'label' => 'Amount (IDR)',
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

        'status' => [
            'label' => 'Status',

            'options' => [

                PayoutStatus::PENDING => 'PENDING',
                PayoutStatus::APPROVED => 'APPROVED',

            ],
        ],

    ],

];
