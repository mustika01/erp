<?php

namespace Kumi\Jinzai\Events\Payroll;

use Kumi\Jinzai\Models\Payroll;
use Illuminate\Foundation\Events\Dispatchable;

class Activated
{
    use Dispatchable;

    public function __construct(
        public Payroll $payroll
    ) {
    }
}
