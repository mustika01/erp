<?php

namespace Kumi\Sousa\EventSubscribers;

use Kumi\Sousa\Events\Vessel\Created;
use Kumi\Sousa\EventListeners\Vessel\InitializeCommonVesselDocuments;

class VesselEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Created::class => [
                InitializeCommonVesselDocuments::class,
            ],
        ];
    }
}
