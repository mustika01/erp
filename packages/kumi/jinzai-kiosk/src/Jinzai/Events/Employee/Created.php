<?php

namespace Kumi\Jinzai\Events\Employee;

use Kumi\Jinzai\Models\Employee;

class Created
{
    public Employee $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }
}
