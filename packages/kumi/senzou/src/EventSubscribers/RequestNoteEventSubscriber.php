<?php

namespace Kumi\Senzou\EventSubscribers;

use Kumi\Senzou\EventListeners\RequestNote\CheckForRequestNoteItems;
use Kumi\Senzou\Events\RequestNote\Committed;

class RequestNoteEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Committed::class => [
                CheckForRequestNoteItems::class,
            ],
        ];
    }
}
