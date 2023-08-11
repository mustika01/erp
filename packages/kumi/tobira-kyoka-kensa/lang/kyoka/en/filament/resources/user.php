<?php

return [

    'columns' => [

        'name' => [
            'label' => 'Name',
        ],

        'email' => [
            'label' => 'Email',
        ],

        'verified' => [
            'label' => 'Verified',
        ],

        'activated' => [
            'label' => 'Active',
        ],

    ],

    'actions' => [

        'activate' => [

            'label' => 'Activate',

            'modal' => [

                'heading' => 'Activate :label',

                'actions' => [

                    'activate' => [

                        'label' => 'Activate',

                    ],

                ],

            ],

            'messages' => [

                'activated' => 'User has been activated.',

            ],

        ],

        'deactivate' => [

            'label' => 'Deactivate',

            'modal' => [

                'heading' => 'Deactivate :label',

                'actions' => [

                    'deactivate' => [

                        'label' => 'Deactivate',

                    ],

                ],

            ],

            'messages' => [

                'deactivated' => 'User has been deactivated.',

            ],

        ],

    ],

    'events' => [

        'created' => 'A new user has been created.',
        'updated' => 'The user\'s details has been updated.',
        'deleted' => 'The user has been deleted.',

        'activated' => 'The user has been activated.',
        'deactivated' => 'The user has been deactivated.',

    ],

];
