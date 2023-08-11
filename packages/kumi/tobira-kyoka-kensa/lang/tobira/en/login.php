<?php

return [

    'title' => 'Login',

    'heading' => 'Sign in to your account',

    'buttons' => [

        'submit' => [
            'label' => 'Continue',
        ],

    ],

    'links' => [

        'account' => [
            'label' => 'Don\'t have an account?',
        ],

        'sign-up' => [
            'label' => 'Sign up',
        ],

    ],

    'fields' => [

        'email' => [
            'label' => 'Email address',
        ],

        'password' => [
            'label' => 'Password',
        ],

        'remember' => [
            'label' => 'Remember me',
        ],

    ],

    'messages' => [
        'failed' => 'These credentials do not match our records.',
        'throttled' => 'Too many login attempts. Please try again in :seconds seconds.',
    ],

];
