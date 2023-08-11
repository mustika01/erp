<?php

return [

    'fields' => [

        'engine_id' => [
            'label' => 'Engine',
        ],

        'label' => [
            'label' => 'Label',
        ],

        'description' => [
            'label' => 'Description',
        ],

        'hourly_consumption' => [
            'label' => 'Consumption',
        ],

    ],

    'columns' => [

        'engine' => [
            'label' => 'Engine',
        ],

        'label' => [
            'label' => 'Label',
        ],

        'hourly_consumption' => [
            'label' => 'Consumption',
        ],

    ],

    'events' => [

        'created' => 'A new formula has been created.',
        'updated' => 'The formula\'s details has been updated.',
        'deleted' => 'The formula has been deleted.',

    ],

];
