<?php

use Kumi\Jinzai\Support\Enums\Gender;
use Kumi\Jinzai\Support\Enums\Religion;
use Kumi\Jinzai\Support\Enums\BloodType;
use Kumi\Jinzai\Support\Enums\MaritalStatus;

return [

    'columns' => [

        'name' => [
            'label' => 'Name',
        ],

        'identity_card_number' => [
            'label' => 'IC No.',
        ],

        'gender' => [

            'label' => 'Gender',

            'options' => [

                Gender::MALE => 'Male',
                Gender::FEMALE => 'Female',

            ],

        ],

        'relation' => [
            'label' => 'Relation',
        ],

    ],

    'fields' => [

        'name' => [
            'label' => 'Name',
        ],

        'identity_card_number' => [
            'label' => 'IC No.',
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

        'education' => [
            'label' => 'Education',
        ],

        'occupation' => [
            'label' => 'Occupation',
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

        'married_at' => [
            'label' => 'Married Date',
        ],

        'relation' => [
            'label' => 'Relation',
        ],

        'nationality' => [
            'label' => 'Nationality',
        ],

        'passport_number' => [
            'label' => 'Passport No.',
        ],

        'permanent_resident_card_number' => [
            'label' => 'PR No.',
        ],

        'father_name' => [
            'label' => 'Father\'s name',
        ],

        'mother_name' => [
            'label' => 'Mother\'s name',
        ],

    ],

    'events' => [

        'created' => 'A new relative has been created.',
        'updated' => 'The relative\'s details has been updated.',
        'deleted' => 'The relative has been deleted.',

    ],

];
