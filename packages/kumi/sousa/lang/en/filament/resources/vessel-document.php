<?php

use Kumi\Sousa\Support\Enums\VesselDocumentStatus;

return [
    'columns' => [
        'sortable_order' => [
            'label' => 'No.',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'document_number' => [
            'label' => 'Document No.',
        ],

        'issued_at' => [
            'label' => 'Issued',
        ],

        'endorse_period_started_at' => [
            'label' => 'Endorse Start',
        ],

        'endorse_period_finished_at' => [
            'label' => 'Endorse Finish',
        ],

        'expired_at' => [
            'label' => 'Expired',
        ],

        'status' => [
            'label' => 'Status',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],
    ],

    'fields' => [
        'name' => [
            'label' => 'Name',
        ],

        'document_number' => [
            'label' => 'Document No.',
        ],

        'issued_at' => [
            'label' => 'Issued Date',
        ],

        'endorse_period_started_at' => [
            'label' => 'Endorse Start Date',
        ],

        'endorse_period_finished_at' => [
            'label' => 'Endorse Finish Date',
        ],

        'expired_at' => [
            'label' => 'Expired Date',
        ],

        'is_permanent' => [
            'label' => 'Permanent',
        ],

        'description' => [
            'label' => 'Description',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],
    ],

    'filters' => [
        'status' => [
            'label' => 'Status',

            'options' => [
                VesselDocumentStatus::ACTIVE => 'Active',
                VesselDocumentStatus::EXPIRING_SOON => 'Expiring Soon',
                VesselDocumentStatus::EXPIRED => 'Expired',
            ],
        ],
    ],

    'events' => [
        'created' => 'A new document has been created.',
        'updated' => 'The document\'s details has been updated.',
        'deleted' => 'The document has been deleted.',
    ],

    'actions' => [
        'preview-expiring-documents' => [
            'label' => 'Preview',
        ],

        'download-expiring-documents' => [
            'label' => 'Download',
        ],
    ],
];
