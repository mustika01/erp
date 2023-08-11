<?php

namespace Kumi\Norikumi\EventSubscribers;

use Kumi\Norikumi\EventListeners\Payout\LogPayoutApprovedEvent;
use Kumi\Norikumi\Events\Payout\Approved;

class PayoutEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Approved::class => [
                LogPayoutApprovedEvent::class,
            ],
        ];
    }
}
