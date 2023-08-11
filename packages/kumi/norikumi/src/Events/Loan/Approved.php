<?php

namespace Kumi\Norikumi\Events\Loan;

use Illuminate\Foundation\Events\Dispatchable;
use Kumi\Norikumi\Models\Loan;

class Approved
{
    use Dispatchable;

    public function __construct(
        public Loan $loan
    ) {
    }
}
