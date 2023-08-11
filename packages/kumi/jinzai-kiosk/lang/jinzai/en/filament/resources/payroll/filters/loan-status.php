<?php

use Kumi\Jinzai\Support\Enums\LoanStatus;

return [

    'title' => 'Loan Status',

    'options' => [

        LoanStatus::PENDING => 'Pending',
        LoanStatus::APPROVED => 'Approved',

    ],

];
