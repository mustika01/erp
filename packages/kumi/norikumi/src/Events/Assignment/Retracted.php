<?php

namespace Kumi\Norikumi\Events\Assignment;

use Illuminate\Foundation\Events\Dispatchable;
use Kumi\Norikumi\Models\Assignment;

class Retracted
{
    use Dispatchable;

    public function __construct(
        public Assignment $assignment
    ) {
        $this->assignment = $assignment;
    }
}
