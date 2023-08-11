<?php

namespace Kumi\Norikumi\Events\Contract;

use Illuminate\Foundation\Events\Dispatchable;
use Kumi\Norikumi\Models\Contract;

class Created
{
    use Dispatchable;

    public function __construct(
        public Contract $contract
    ) {
        $this->contract = $contract;
    }
}
