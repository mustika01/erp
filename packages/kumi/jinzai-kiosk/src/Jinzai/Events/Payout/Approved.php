<?php

namespace Kumi\Jinzai\Events\Payout;

use Kumi\Jinzai\Models\Payout;
use Illuminate\Foundation\Events\Dispatchable;

class Approved
{
    use Dispatchable;

    public function __construct(
        public Payout $payout
    ) {
    }
}
