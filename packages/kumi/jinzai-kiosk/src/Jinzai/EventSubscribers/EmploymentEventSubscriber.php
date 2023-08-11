<?php

namespace Kumi\Jinzai\EventSubscribers;

use Kumi\Jinzai\Events\Employment\Updated;
use Kumi\Jinzai\EventListeners\Employment\CheckForLeaveResignDate;

class EmploymentEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Updated::class => [
                CheckForLeaveResignDate::class,
            ],
        ];
    }
}
