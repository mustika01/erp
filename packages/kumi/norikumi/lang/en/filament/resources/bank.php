<?php

use Kumi\Norikumi\Support\Enums\BankProvider;

return [
    'columns' => [
        'bank_name' => [
            'label' => 'Bank Name',
        ],

        'account_number' => [
            'label' => 'Account No.',
        ],

        'account_holder_name' => [
            'label' => 'Account Holder Name',
        ],

        'is_primary' => [
            'label' => 'Primary Account',
        ],
    ],

    'fields' => [
        'bank_name' => [
            'label' => 'Bank Name',

            'options' => [
                BankProvider::BCA => 'BCA - BANK CENTRAL ASIA',
                BankProvider::MANDIRI => 'MANDIRI - BANK MANDIRI',
                BankProvider::BNI => 'BNI - BANK NEGARA INDONESIA',
                BankProvider::BRI => 'BRI - BANK RAKYAT INDONESIA',
                BankProvider::BTN => 'BTN - BANK TABUNGAN NEGARA',
                BankProvider::BSI => 'BSI - BANK SYARIAH INDONESIA',
            ],
        ],

        'account_number' => [
            'label' => 'Account No.',
        ],

        'account_holder_name' => [
            'label' => 'Account Holder Name',
        ],

        'is_primary' => [
            'label' => 'Primary Account',
        ],
    ],

    'events' => [
        'created' => 'A new bank has been created.',
        'updated' => 'The bank\'s details has been updated.',
        'deleted' => 'The bank has been deleted.',
    ],
];
