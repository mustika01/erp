<?php

return [

    'columns' => [

        'executed_at' => [
            'label' => 'Date',
        ],

        'tonnage_amount_formatted' => [
            'label' => 'Tonnage Amount (t)',
        ],

    ],

    'fields' => [

        'tonnage_amount' => [
            'label' => 'Tonnage Amount',
        ],

        'executed_at' => [
            'label' => 'Date',
        ],

        'remarks' => [
            'label' => 'Remarks',
        ],

    ],

    'events' => [

        'created' => 'A new cargo log has been created.',
        'updated' => 'The cargo log\'s details has been updated.',
        'deleted' => 'The cargo log has been deleted.',

    ],

];
