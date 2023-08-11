<?php

namespace Kumi\Norikumi\Events\Payroll;

use Illuminate\Foundation\Events\Dispatchable;
use Kumi\Norikumi\Models\Payroll;

class Activated
{
    use Dispatchable;

    public function __construct(
        public Payroll $payroll
    ) {
    }
}
