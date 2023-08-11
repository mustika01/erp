<?php

use Kumi\Senzou\Support\Enums\Position;

return [
    'fields' => [
        'vessel' => [
            'label' => 'Vessel',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'email' => [
            'label' => 'Email',
        ],

        'password' => [
            'label' => 'Password',
        ],

        'position' => [
            'label' => 'Position',

            'options' => [
                Position::NAHKODA => 'Nahkoda',
                Position::KKM => 'Chief Engineer',
                Position::CHIEF_OFFICER => 'Chief Officer',
            ],
        ],
    ],

    'columns' => [
        'vessel' => [
            'label' => 'Vessel',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'email' => [
            'label' => 'Email',
        ],

        'password' => [
            'label' => 'Password',
        ],

        'position' => [
            'label' => 'Position',
        ],
    ],
];
