<?php

namespace Kumi\Jinzai\EventSubscribers;

use Kumi\Jinzai\Events\Payroll\Activated;
use Kumi\Jinzai\EventListeners\Payroll\InitializeSalaryPayout;

class PayrollEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Activated::class => [
                InitializeSalaryPayout::class,
            ],
        ];
    }
}
