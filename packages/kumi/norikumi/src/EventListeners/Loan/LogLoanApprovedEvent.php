<?php

namespace Kumi\Norikumi\EventListeners\Loan;

use Kumi\Norikumi\Events\Loan\Approved;

class LogLoanApprovedEvent
{
    public function handle(Approved $event)
    {
        activity()
            ->performedOn($event->loan)
            ->log(__('norikumi::filament/resources/loan.events.approved'))
        ;
    }
}
