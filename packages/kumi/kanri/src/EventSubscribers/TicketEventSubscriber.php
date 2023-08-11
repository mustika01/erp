<?php

namespace Kumi\Kanri\EventSubscribers;

use Kumi\Kanri\EventListeners\Ticket\InitializeLoan;
use Kumi\Kanri\Events\Ticket\SalaryAdvanceTicketApproved;

class TicketEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            SalaryAdvanceTicketApproved::class => [
                InitializeLoan::class,
            ],
        ];
    }
}
