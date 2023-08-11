<?php

namespace Kumi\Kyoka\Events\Subscribers;

use Kumi\Kyoka\Events\User\Activated;
use Kumi\Kyoka\Events\User\Deactivated;

class UserEventSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        return [
            Activated::class => 'onActivated',
            Deactivated::class => 'onDeactivated',
        ];
    }

    public function onActivated(Activated $event): void
    {
        activity()
            ->performedOn($event->user)
            ->log(__('kyoka::filament/resources/user.events.activated'))
        ;
    }

    public function onDeactivated(Deactivated $event): void
    {
        activity()
            ->performedOn($event->user)
            ->log(__('kyoka::filament/resources/user.events.deactivated'))
        ;
    }
}
