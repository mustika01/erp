<?php

use Kumi\Sousa\Support\Enums\BunkerJournalEntryType;

return [

    'fields' => [

        'type' => [

            'options' => [
                BunkerJournalEntryType::USAGE => 'Usage',
                BunkerJournalEntryType::REFUEL => 'Re-Fuel',
                BunkerJournalEntryType::ADJUSTMENT => 'Adjustment',
            ],

        ],

    ],

];
