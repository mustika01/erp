<?php

namespace Kumi\Jinzai\EventSubscribers;

use Kumi\Jinzai\Events\Employee\Created;
use Kumi\Jinzai\Events\Employee\Onboarded;
use Kumi\Jinzai\EventListeners\Employee\DispatchCreateMailboxJob;
use Kumi\Jinzai\EventListeners\Employee\LogEmployeeOnboardedEvent;

class EmployeeEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Created::class => [
                DispatchCreateMailboxJob::class,
            ],

            Onboarded::class => [
                LogEmployeeOnboardedEvent::class,
            ],
        ];
    }
}
