<?php

namespace Kumi\Sousa\Events\Vessel;

use Kumi\Sousa\Models\Vessel;
use Illuminate\Foundation\Events\Dispatchable;

class Created
{
    use Dispatchable;

    public function __construct(
        public Vessel $vessel
    ) {
    }
}
