<?php

use Kumi\Jinzai\Support\Enums\IdentityType;
use Kumi\Jinzai\Support\Enums\IdentityStatus;

return [

    'columns' => [

        'type' => [

            'label' => 'Type',

            'options' => [

                IdentityType::PASSPORT => 'Passport',
                IdentityType::FAMILY_CARD => 'Family Card',
                IdentityType::IDENTITY_CARD => 'Identity Card',
                IdentityType::DRIVING_LICENSE => 'Driving License',

            ],
        ],

        'number' => [
            'label' => 'Number',
        ],

        'expired_at' => [
            'label' => 'Expiry Date',
        ],

        'status' => [

            'label' => 'Status',

            'options' => [

                IdentityStatus::PERMANENT => 'PERMANENT',
                IdentityStatus::ACTIVE => 'ACTIVE',
                IdentityStatus::EXPIRED => 'EXPIRED',

            ],
        ],

    ],

    'fields' => [

        'type' => [

            'label' => 'Type',

            'options' => [

                IdentityType::PASSPORT => 'Passport',
                IdentityType::FAMILY_CARD => 'Family Card',
                IdentityType::IDENTITY_CARD => 'Identity Card',
                IdentityType::DRIVING_LICENSE => 'Driving License',

            ],

        ],

        'number' => [
            'label' => 'Number',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],

        'expired_at' => [
            'label' => 'Expiry Date',
        ],

        'is_permanent' => [
            'label' => 'Permanent',
        ],

        'front_side' => [
            'label' => 'Front side',
        ],

        'back_side' => [
            'label' => 'Back side',
        ],

    ],

    'filters' => [

        'status' => [

            'label' => 'Status',

            'options' => [

                IdentityStatus::PERMANENT => 'Permanent',
                IdentityStatus::ACTIVE => 'Active',
                IdentityStatus::EXPIRED => 'Expired',

            ],
        ],

    ],

    'events' => [

        'created' => 'A new identity has been created.',
        'updated' => 'The identity\'s details has been updated.',
        'deleted' => 'The identity has been deleted.',

    ],

];
