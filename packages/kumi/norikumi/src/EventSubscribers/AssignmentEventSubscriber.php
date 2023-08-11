<?php

namespace Kumi\Norikumi\EventSubscribers;

use Kumi\Norikumi\EventListeners\Assignment\CheckForRetractedDate;
use Kumi\Norikumi\Events\Assignment\Retracted;

class AssignmentEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Retracted::class => [
                CheckForRetractedDate::class,
            ],
        ];
    }
}
