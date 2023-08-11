<?php

namespace Kumi\Norikumi\EventSubscribers;

use Kumi\Norikumi\EventListeners\Payroll\InitializeSalaryPayout;
use Kumi\Norikumi\Events\Payroll\Activated;

class PayrollEventSubscriber
{
    public function subscribe($event): array
    {
        return [
            Activated::class => [
                InitializeSalaryPayout::class,
            ],
        ];
    }
}
