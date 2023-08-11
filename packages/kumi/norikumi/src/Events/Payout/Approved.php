<?php

namespace kumi\Norikumi\Events\Payout;

use Illuminate\Foundation\Events\Dispatchable;
use Kumi\Norikumi\Models\Payout;

class Approved
{
    use Dispatchable;

    public function __construct(
        public Payout $payout
    ) {
    }
}
