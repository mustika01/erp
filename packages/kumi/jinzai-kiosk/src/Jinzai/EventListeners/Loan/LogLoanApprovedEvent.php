<?php

namespace Kumi\Jinzai\EventListeners\Loan;

use Kumi\Jinzai\Events\Loan\Approved;

class LogLoanApprovedEvent
{
    public function handle(Approved $event)
    {
        activity()
            ->performedOn($event->loan)
            ->log(__('jinzai::filament/resources/loan.events.approved'))
        ;
    }
}
