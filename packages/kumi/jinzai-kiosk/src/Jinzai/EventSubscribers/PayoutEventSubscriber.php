<?php

namespace Kumi\Jinzai\EventSubscribers;

use Kumi\Jinzai\Events\Payout\Approved;
use Kumi\Jinzai\EventListeners\Payout\LogPayoutApprovedEvent;

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
