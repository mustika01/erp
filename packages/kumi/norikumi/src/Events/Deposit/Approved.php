<?php

namespace Kumi\Norikumi\Events\Deposit;

use Illuminate\Foundation\Events\Dispatchable;
use Kumi\Norikumi\Models\Deposit;

class Approved
{
    use Dispatchable;

    public function __construct(
        public Deposit $deposit
    ) {
    }
}
