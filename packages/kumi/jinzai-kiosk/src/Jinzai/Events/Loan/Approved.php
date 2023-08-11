<?php

namespace Kumi\Jinzai\Events\Loan;

use Kumi\Jinzai\Models\Loan;
use Illuminate\Foundation\Events\Dispatchable;

class Approved
{
    use Dispatchable;

    public function __construct(
        public Loan $loan
    ) {
    }
}
