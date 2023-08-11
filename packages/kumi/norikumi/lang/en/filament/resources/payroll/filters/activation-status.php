<?php

use Kumi\Norikumi\Support\Enums\ActivationStatus;

return [
    'title' => 'Activation Status',

    'options' => [
        ActivationStatus::ACTIVATED => 'Activated',
        ActivationStatus::NOT_ACTIVATED => 'Not Activated',
    ],
];
