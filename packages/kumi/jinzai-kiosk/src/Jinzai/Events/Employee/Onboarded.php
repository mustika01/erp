<?php

namespace Kumi\Jinzai\Events\Employee;

use Kumi\Jinzai\Models\Employee;
use Illuminate\Foundation\Events\Dispatchable;

class Onboarded
{
    use Dispatchable;

    public Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
}
