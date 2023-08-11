<?php

use Kumi\Jinzai\Support\Enums\EmploymentStatus;

return [
    'columns' => [
        'department' => [
            'label' => 'Department',
        ],

        'name' => [
            'label' => 'Name',
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

        'name' => [
            'label' => 'Name',
        ],
    ],

    'filters' => [
        'department' => [
            'label' => 'Department',
        ],
    ],

    'events' => [
        'created' => 'A new contract has been created.',
        'updated' => 'The contract\'s details has been updated.',
        'deleted' => 'The contract has been deleted.',
    ],

    'sections' => [
        'employee-data' => 'Employee Data',
        'contract-details' => 'Contract Details',
    ],
];
