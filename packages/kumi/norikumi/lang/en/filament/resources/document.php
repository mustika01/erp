<?php

use Kumi\Norikumi\Support\Enums\DocumentStatus;
use Kumi\Norikumi\Support\Enums\DocumentType;

return [
    'columns' => [
        'type' => [
            'label' => 'Type',

            'options' => [
                DocumentType::CERTIFICATION => 'Certification',
                DocumentType::DIPLOMA_DEGREE_RATINGS => 'Diploma / Degree / RATINGS',
                DocumentType::SEAMAN_SERVICE_BOOK => 'Seaman\'s Service Book',
                DocumentType::MEDICAL_CHECKUP => 'Medical Check-up',
                DocumentType::DELEGATION => 'Delegation',
                DocumentType::CREW_FORM => 'Crew Form',
                DocumentType::AGREEMENT => 'Agreement',
                DocumentType::SIGN_ON => 'Sign On',
                DocumentType::SIGN_OFF => 'Sign Off',
                DocumentType::YELLOW_FEVER => 'Yellow Fever',
                DocumentType::GM_DSS => 'GM DSS',
                DocumentType::ORU => 'ORU',
                DocumentType::SHIP_MUTATION => 'Ship Mutation',
                DocumentType::PKL => 'PKL',
                DocumentType::BST => 'BST',
                DocumentType::VAKSIN => 'Vaksin',
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
                DocumentStatus::PERMANENT => 'PERMANENT',
                DocumentStatus::ACTIVE => 'ACTIVE',
                DocumentStatus::EXPIRED => 'EXPIRED',
            ],
        ],
    ],

    'fields' => [
        'type' => [
            'label' => 'Type',

            'options' => [
                DocumentType::CERTIFICATION => 'Certification',
                DocumentType::DIPLOMA_DEGREE_RATINGS => 'Diploma / Degree / RATINGS',
                DocumentType::SEAMAN_SERVICE_BOOK => 'Seaman\'s Service Book',
                DocumentType::MEDICAL_CHECKUP => 'Medical Check-up',
                DocumentType::DELEGATION => 'Delegation',
                DocumentType::CREW_FORM => 'Crew Form',
                DocumentType::AGREEMENT => 'Agreement',
                DocumentType::SIGN_ON => 'Sign On',
                DocumentType::SIGN_OFF => 'Sign Off',
                DocumentType::YELLOW_FEVER => 'Yellow Fever',
                DocumentType::GM_DSS => 'GM DSS',
                DocumentType::ORU => 'ORU',
                DocumentType::SHIP_MUTATION => 'Ship Mutation',
                DocumentType::PKL => 'PKL',
                DocumentType::BST => 'BST',
                DocumentType::VAKSIN => 'Vaksin',
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

        'document' => [
            'label' => 'Upload Document',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Status',

            'options' => [
                DocumentStatus::PERMANENT => 'Permanent',
                DocumentStatus::ACTIVE => 'Active',
                DocumentStatus::EXPIRED => 'Expired',
            ],
        ],
    ],

    'events' => [
        'created' => 'A new document has been created.',
        'updated' => 'The document\'s details has been updated.',
        'deleted' => 'The document has been deleted.',
    ],
];
