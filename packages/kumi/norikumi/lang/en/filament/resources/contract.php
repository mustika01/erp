<?php

use Kumi\Norikumi\Support\Enums\Position;

return [
    'columns' => [
        'position' => [
            'label' => 'Position',

            'options' => [
                Position::NAHKODA => 'Nahkoda',
                Position::MUALIM => 'Mualim',
                Position::KKM => 'KKM',
                Position::MASINIS => 'Masinis',
                Position::BOSUN => 'Bosun',
                Position::KELASI => 'Kelasi',
                Position::MANDOR => 'Mandor',
                Position::JURU_MUDI => 'Juru Mudi',
                Position::JURU_MINYAK => 'Juru Minyak',
                Position::JURU_MASAK => 'Juru Masak',
                Position::CADET_DECK => 'Cadet (Deck)',
                Position::CADET_ENGINE => 'Cadet (Engine)',
                Position::WIPER => 'Wiper',
                Position::CRANE_OPERATOR => 'Crane Operator',
                Position::MESS_BOY => 'Mess Boy',
            ],
        ],

        'grade' => [
            'label' => 'Grade',
        ],

        'started_at' => [
            'label' => 'Start Contract',
        ],

        'ended_at' => [
            'label' => 'End Contract',
        ],

        'started_at_formatted' => [
            'label' => 'Start Contract',
        ],

        'ended_at_formatted' => [
            'label' => 'End Contract',
        ],

        'duration' => [
            'label' => 'Duration Contract',
        ],
    ],

    'fields' => [
        'position' => [
            'label' => 'Position',

            'options' => [
                Position::NAHKODA => 'Nahkoda',
                Position::MUALIM => 'Mualim',
                Position::KKM => 'KKM',
                Position::MASINIS => 'Masinis',
                Position::BOSUN => 'Bosun',
                Position::KELASI => 'Kelasi',
                Position::MANDOR => 'Mandor',
                Position::JURU_MUDI => 'Juru Mudi',
                Position::JURU_MINYAK => 'Juru Minyak',
                Position::JURU_MASAK => 'Juru Masak',
                Position::CADET_DECK => 'Cadet (Deck)',
                Position::CADET_ENGINE => 'Cadet (Engine)',
                Position::WIPER => 'Wiper',
                Position::CRANE_OPERATOR => 'Crane Operator',
                Position::MESS_BOY => 'Mess Boy',
            ],
        ],

        'grade' => [
            'label' => 'Grade',
        ],

        'started_at' => [
            'label' => 'Start Contract',
        ],

        'ended_at' => [
            'label' => 'End Contract',
        ],
    ],

    'events' => [
        'created' => 'A new contract has been created.',
        'updated' => 'The contract\'s details has been updated.',
        'deleted' => 'The contract has been deleted.',
    ],
];
