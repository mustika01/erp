<?php

use Kumi\Norikumi\Support\Enums\DepartmentType;
use Kumi\Norikumi\Support\Enums\CertificationType;

return [

    'fields' => [

        'name' => [
            'label' => 'Name',
        ],

        'department' => [
            'label' => 'Department',

            'options' => [

                DepartmentType::DECK => 'Deck',
                DepartmentType::ENGINE => 'Engine',

            ],
        ],

        'pin_code' => [
            'label' => 'PIN Code',
        ],

        'email' => [
            'label' => 'Email',
        ],

        'mobile_number' => [
            'label' => 'Mobile No.',
        ],

        'place_of_birth' => [
            'label' => 'Place of Birth',
        ],

        'date_of_birth' => [
            'label' => 'Date of Birth',
        ],

        'gender' => [
            'label' => 'Gender',
        ],

        'marriage_status' => [
            'label' => 'Marriage Status',
        ],

        'identity_card_number' => [
            'label' => 'NIC No.',
        ],

        'family_card_number' => [
            'label' => 'Family Card No.',
        ],

        'wearpack_size' => [
            'label' => 'Wearpack Size',
        ],

        'safety_shoes_size' => [
            'label' => 'Safety Shoes Size',
        ],

        'account_name' => [
            'label' => 'Account Name',
        ],

        'bank_name' => [
            'label' => 'Bank Name',
        ],

        'account_number' => [
            'label' => 'Account No.',
        ],

        'tax_card_number' => [
            'label' => 'Tax Card No.',
        ],

        'certification_type' => [
            'label' => 'Certification Type',

            'options' => [

                CertificationType::CERTIFICATE => 'Certificate',
                CertificationType::RATINGS_OR_ABLE => 'RATINGS / ABLE',

            ],
        ],

        'certificate_number' => [
            'label' => 'Cert No.',
        ],

        'certificate_level' => [
            'label' => 'Cert Level',
        ],

        'endorsement_number' => [
            'label' => 'Endorsement No.',
        ],

        'endorsement_expiry_date' => [
            'label' => 'Endorsement Expiry Date',
        ],

        'ratings_or_able_number' => [
            'label' => 'RATINGS/ABLE No.',
        ],

        'ratings_or_able_expiry_date' => [
            'label' => 'RATINGS/ABLE Expiry Date',
        ],

        'basic_safety_training_number' => [
            'label' => 'BST No.',
        ],

        'basic_safety_training_expiry_date' => [
            'label' => 'BST Expiry Date',
        ],

        'seafarer_book_number' => [
            'label' => 'Seafarer\'s Book No.',
        ],

        'seafarer_book_expiry_date' => [
            'label' => 'Seafarer\'s Book Expiry Date',
        ],

        'emergency_contact_name' => [
            'label' => 'Emergency Contact Name',
        ],

        'emergency_contact_number' => [
            'label' => 'Emergency Contact No.',
        ],

    ],

    'columns' => [

        'id' => [
            'label' => 'No.',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'department' => [
            'label' => 'Department',

            'options' => [

                DepartmentType::DECK => 'Deck',
                DepartmentType::ENGINE => 'Engine',

            ],
        ],

        'pin_code' => [
            'label' => 'PIN',
        ],

        'completed_date' => [
            'label' => 'Completed Date',
        ],

    ],

    'actions' => [

        'archive' => [

            'single' => [

                'label' => 'Archive',

                'modal' => [

                    'heading' => 'Archive :label',

                    'actions' => [

                        'archive' => [
                            'label' => 'Archive',
                        ],

                    ],

                ],

                'messages' => [
                    'archived' => 'Archived',
                ],

            ],

        ],

        'download' => [

            'single' => [

                'label' => 'Download',

            ],

        ],

    ],

];
