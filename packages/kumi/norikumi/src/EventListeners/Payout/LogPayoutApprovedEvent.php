<?php

namespace Kumi\Norikumi\EventListeners\Payout;

use kumi\Norikumi\Events\Payout\Approved;

class LogPayoutApprovedEvent
{
    public function handle(Approved $event)
    {
        activity()
            ->performedOn($event->payout)
            ->log(__('norikumi::filament/resources/payout.events.approved'))
        ;
    }
}
