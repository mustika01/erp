<?php

namespace Kumi\Jinzai\EventListeners\Payout;

use Kumi\Jinzai\Events\Payout\Approved;

class LogPayoutApprovedEvent
{
    public function handle(Approved $event)
    {
        activity()
            ->performedOn($event->payout)
            ->log(__('jinzai::filament/resources/payout.events.approved'))
        ;
    }
}
