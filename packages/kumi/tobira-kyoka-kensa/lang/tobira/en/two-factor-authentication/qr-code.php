<?php

return [

    'messages' => [

        'instruction' => 'To enable 2FA, please follow the instructions below:',

    ],

    'steps' => [

        1 => 'Download Google Authenticator from App Store or Google Play Store.',
        2 => 'Scan the QR Code.',
        3 => 'Enter the OTP Code shown in the application.',

    ],

    'buttons' => [

        'submit' => [
            'label' => 'Continue',
        ],

    ],

    'fields' => [

        'otp' => [
            'label' => 'OTP Code',
        ],

    ],

    'validations' => [

        'otp' => 'Invalid OTP Code',

    ],

];
