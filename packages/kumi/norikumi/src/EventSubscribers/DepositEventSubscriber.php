<?php

namespace Kumi\Norikumi\EventSubscribers;

use Kumi\Norikumi\EventListeners\Deposit\InitializeDepositPayments;
use Kumi\Norikumi\EventListeners\Deposit\LinkOldestDepositPaymentToPayoutItem;
use Kumi\Norikumi\Events\Deposit\Approved;

class DepositEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Approved::class => [
                InitializeDepositPayments::class,
                LinkOldestDepositPaymentToPayoutItem::class,
            ],
        ];
    }
}
