<?php

use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\MaritalStatus;

return [

    'buttons' => [

        'create_onboarding_link' => [
            'label' => 'Create onboarding link',
        ],

        'create_payroll' => [
            'label' => 'Create payroll',
        ],

        'view_payroll' => [
            'label' => 'View payroll',
        ],

    ],

    'columns' => [

        'internal_id' => [
            'label' => 'ID',
        ],

        'name' => [
            'label' => 'Name',
        ],

        'email' => [
            'label' => 'Email',
        ],

        'mobile' => [
            'label' => 'Mobile',
        ],

        'gender' => [
            'label' => 'Gender',
        ],

        'marital_status' => [
            'label' => 'Marital Status',
        ],

        'religion' => [
            'label' => 'Religion',
        ],

    ],

    'fields' => [

        'mobile' => [
            'label' => 'Mobile',
        ],

        'landline' => [
            'label' => 'Landline',
        ],

        'gender' => [

            'label' => 'Gender',

            'options' => [

                Gender::MALE => 'Male',
                Gender::FEMALE => 'Female',

            ],

        ],

        'place_of_birth' => [
            'label' => 'Place of birth',
        ],

        'date_of_birth' => [
            'label' => 'Date of birth',
        ],

        'blood_type' => [

            'label' => 'Blood type',

            'options' => [

                BloodType::TYPE_A => 'A',
                BloodType::TYPE_B => 'B',
                BloodType::TYPE_AB => 'AB',
                BloodType::TYPE_O => 'O',

            ],

        ],

        'marital_status' => [

            'label' => 'Marital status',

            'options' => [

                MaritalStatus::SINGLE => 'Single',
                MaritalStatus::MARRIED => 'Married',
                MaritalStatus::WIDOW => 'Widow',
                MaritalStatus::WIDOWER => 'Widower',

            ],

        ],

        'religion' => [

            'label' => 'Religion',

            'options' => [

                Religion::CATHOLIC => 'Catholic',
                Religion::ISLAM => 'Islam',
                Religion::CHRISTIAN => 'Christian',
                Religion::BUDDHA => 'Buddha',
                Religion::HINDU => 'Hindu',
                Religion::CONFUCIOUS => 'Confucious',
                Religion::OTHERS => 'Others',

            ],

        ],

    ],

    'filters' => [

        'gender' => [
            'label' => 'Gender',
        ],

        'marital_status' => [
            'label' => 'Marital Status',
        ],

        'religion' => [
            'label' => 'Religion',
        ],

        'department' => [
            'label' => 'Department',
        ],

    ],

    'relationships' => [

        'user' => [

            'fields' => [

                'name' => [
                    'label' => 'Name',
                ],

                'email' => [
                    'label' => 'Email',
                ],

            ],

        ],

    ],

    'events' => [

        'created' => 'A new employee has been created.',
        'updated' => 'The employee\'s details has been updated.',
        'deleted' => 'The employee has been deleted.',

    ],

];
