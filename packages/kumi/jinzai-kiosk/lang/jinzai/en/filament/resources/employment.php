<?php

use Kumi\Jinzai\Support\Enums\EmploymentStatus;

return [
    'columns' => [
        'department' => [
            'label' => 'Department',
        ],

        'position' => [
            'label' => 'Position',
        ],

        'joined_at' => [
            'label' => 'Join Date',
        ],

        'contract_started_at' => [
            'label' => 'Contract Start Date',
        ],

        'contract_ended_at' => [
            'label' => 'Contract End Date',
        ],

        'left_at' => [
            'label' => 'Leave Date',
        ],

        'resigned_at' => [
            'label' => 'Resign Date',
        ],

        'status' => [
            'label' => 'Status',

            'options' => [
                EmploymentStatus::PERMANENT => 'Permanent',
                EmploymentStatus::CONTRACT => 'Contract',
                EmploymentStatus::PROBATION => 'Probation',
            ],
        ],
    ],

    'fields' => [
        'status' => [
            'label' => 'Status',

            'options' => [
                EmploymentStatus::PERMANENT => 'Permanent',
                EmploymentStatus::CONTRACT => 'Contract',
                EmploymentStatus::PROBATION => 'Probation',
            ],
        ],

        'department' => [
            'label' => 'Department',
        ],

        'job_position' => [
            'label' => 'Position',
        ],

        'joined_at' => [
            'label' => 'Join Date',
        ],

        'contract_started_at' => [
            'label' => 'Contract Start Date',
        ],

        'contract_ended_at' => [
            'label' => 'Contract End Date',
        ],

        'left_at' => [
            'label' => 'Leave Date',
        ],

        'resigned_at' => [
            'label' => 'Resign Date',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],
    ],

    'events' => [
        'created' => 'A new employment has been created.',
        'updated' => 'The employment\'s details has been updated.',
        'deleted' => 'The employment has been deleted.',
    ],
];
