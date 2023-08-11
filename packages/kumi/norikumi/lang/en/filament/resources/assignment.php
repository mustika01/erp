<?php

use Kumi\Norikumi\Support\Enums\Position;
use Kumi\Norikumi\Support\Enums\ShipOwner;

return [
    'columns' => [
        'sortable_order' => [
            'label' => 'No.',
        ],

        'vessel' => [
            'label' => 'Vessel',
        ],

        'crew' => [
            'label' => 'Crew Name',
        ],

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

        'seafare_code' => [
            'label' => 'Seafare Code',
        ],

        'ship_owner' => [
            'label' => 'Ship Owner',

            'options' => [
                ShipOwner::PT_LBN => 'PT. Lintas Bahari Nusantara',
                ShipOwner::PT_LAI => 'PT. Lintas Armada Indonesia',
            ],
        ],

        'premi' => [
            'label' => 'Premi',
        ],

        'place' => [
            'label' => 'Place of Sijil',
        ],

        'sijil_date' => [
            'label' => 'Date of Sijil',
        ],

        'assigned_at_formatted' => [
            'label' => 'Assigned Date',
        ],

        'retracted_at_formatted' => [
            'label' => 'Retracted Date',
        ],

        'assignments_count' => [
            'label' => 'No. of Crews',
        ],

        'sijil_date_formatted' => [
            'label' => 'Date of Sijil',
        ],
    ],

    'fields' => [
        'vessel' => [
            'label' => 'Vessel',
        ],

        'crew' => [
            'label' => 'Crew Name',
        ],

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

        'seafare_code' => [
            'label' => 'Seafare Code',
        ],

        'ship_owner' => [
            'label' => 'Ship Owner',

            'options' => [
                ShipOwner::PT_LBN => 'PT. Lintas Bahari Nusantara',
                ShipOwner::PT_LAI => 'PT. Lintas Armada Indonesia',
            ],
        ],

        'premi' => [
            'label' => 'Premi',
        ],

        'assigned_at' => [
            'label' => 'Assigned Date',
        ],

        'retracted_at' => [
            'label' => 'Retracted Date',
        ],

        'place' => [
            'label' => 'Place of Sijil',
        ],

        'sijil_date' => [
            'label' => 'Date of Sijil',
        ],
    ],

    'events' => [
        'created' => 'A new assignment has been created.',
        'updated' => 'The assignment\'s details has been updated.',
        'deleted' => 'The assignment has been deleted.',
    ],

    'sections' => [
        'vessel' => 'Vessel Data',
        'crew' => 'Crew Data',

        'sijil' => 'Sijil Date & Place',
    ],
];
