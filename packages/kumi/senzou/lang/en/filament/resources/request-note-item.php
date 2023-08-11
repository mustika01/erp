<?php

use Kumi\Senzou\Support\Enums\RequestNoteItemStatus;

return [
    'columns' => [
        'name' => [
            'label' => 'Name',
        ],

        'quantity' => [
            'label' => 'Quantity',
        ],

        'stock_on_vessel' => [
            'label' => 'Stock on Vessel',
        ],

        'reason' => [
            'label' => 'Reason',
        ],

        'rejected' => [
            'label' => 'Reject',
        ],

        'approved' => [
            'label' => 'Approve',
        ],

        'status' => [
            'label' => 'Status',

            'options' => [
                RequestNoteItemStatus::PENDING => 'PENDING',
                RequestNoteItemStatus::APPROVED => 'APPROVED',
                RequestNoteItemStatus::REJECTED => 'REJECTED',
            ],
        ],
    ],
];
