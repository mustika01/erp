<?php

return [

    'title' => 'Onboarding',

    'heading' => 'Set up your account',

    'fields' => [

        'onboarding_link' => [
            'label' => 'Onboarding link',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'password' => [
            'label' => 'Password',
        ],

        'password_confirmation' => [
            'label' => 'Password confirmation',
        ],

    ],

    'buttons' => [

        'copy' => [
            'label' => 'Copy',
        ],

        'copied' => [
            'label' => 'Copied',
        ],

        'submit' => [
            'label' => 'Continue',
        ],

    ],

    'events' => [

        'created' => 'A new onboarding link has been created.',
        'onboarded' => 'The employee has finished the onboarding process.',

    ],

];
