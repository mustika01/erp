<?php

namespace Kumi\Norikumi\EventSubscribers;

use Kumi\Norikumi\EventListeners\Contract\CheckForDeposit;
use Kumi\Norikumi\Events\Contract\Created;

class ContractEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Created::class => [
                CheckForDeposit::class,
            ],
        ];
    }
}
