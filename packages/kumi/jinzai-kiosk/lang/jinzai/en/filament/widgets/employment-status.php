<?php

use Kumi\Jinzai\Support\Enums\EmploymentStatus;

return [

    'title' => 'Employment Status',

    'labels' => [

        'total' => 'Total',

    ],

    'options' => [

        EmploymentStatus::PERMANENT => 'Permanent',
        EmploymentStatus::CONTRACT => 'Contract',
        EmploymentStatus::PROBATION => 'Probation',

    ],

];
