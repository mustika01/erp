<?php

use Kumi\Kiosk\Support\Enums\TicketStatus;

return [

    'fields' => [

        'category' => [
            'label' => 'Category A',
        ],

        'child_category' => [
            'label' => 'Category B',
        ],

        'grand_child_category' => [
            'label' => 'Category C',
        ],

        'description' => [
            'label' => 'Description',
        ],

        'attachments' => [
            'label' => 'Attachments',
        ],

        'status' => [
            'label' => 'Status',
        ],

    ],

    'columns' => [

        'id' => [
            'label' => 'No.',
        ],

        'employee' => [
            'label' => 'Employee',
        ],

        'category' => [
            'label' => 'Category A',
        ],

        'child_category' => [
            'label' => 'Category B',
        ],

        'status' => [
            'label' => 'Status',
        ],

        'created_at' => [
            'label' => 'Created Date',
        ],

    ],

    'statuses' => [

        TicketStatus::PENDING => 'Pending',
        TicketStatus::APPROVED => 'Approved',
        TicketStatus::REJECTED => 'Rejected',
        TicketStatus::RESOLVED => 'Resolved',
        TicketStatus::UNDER_REVIEW => 'Under Review',

    ],

    'events' => [

        'created' => 'A new ticket has been created.',
        'updated' => 'The ticket\'s details has been updated.',
        'deleted' => 'The ticket has been deleted.',

    ],

];
