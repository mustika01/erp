<?php

return [

    'title' => 'Two Factor Authentication',

    'heading' => 'Two Factor Authentication',

    'messages' => [

        'instruction-code' => 'Please confirm access to your account by entering the authentication code provided by your authenticator application.',

        'instruction-recovery' => 'Please confirm access to your account by entering one of your emergency recovery codes.',

    ],

    'buttons' => [

        'submit' => [
            'label' => 'Continue',
        ],

        'recovery' => [
            'label' => 'Use recovery code',
        ],

        'code' => [
            'label' => 'Use OTP code',
        ],

    ],

    'links' => [

        'cancel' => [
            'label' => 'Changed your mind?',
        ],

        'log-in' => [
            'label' => 'Log in',
        ],

    ],

    'fields' => [

        'code' => [
            'label' => 'OTP Code',
        ],

        'recovery' => [
            'label' => 'Recovery Code',
        ],

    ],

];
