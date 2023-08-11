<?php

return [

    'title' => 'Email Verification',

    'heading' => 'Verify your email',

    'messages' => [

        'prompt' => 'Before getting started, pleases verify your email by clicking on the link in the email we sent.'
                . ' ' . 'If you didn\'t receive the email, we will gladly send you another.',

        'resent' => 'A new verification link has been sent to your email address.',

        'throttled' => 'Too many resend attempts. Please try again in :seconds seconds.',

    ],

    'buttons' => [

        'submit' => [
            'label' => 'Resend email verification link',
        ],

    ],

    'links' => [

        'cancel' => [
            'label' => 'Changed your mind?',
        ],

        'log-out' => [
            'label' => 'Log out',
        ],

    ],

    'verification-link-sent' => 'A verification link has been sent to your email address.',

];
