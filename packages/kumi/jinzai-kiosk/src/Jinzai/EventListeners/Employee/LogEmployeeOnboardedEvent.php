<?php

namespace Kumi\Jinzai\EventListeners\Employee;

use Kumi\Jinzai\Events\Employee\Onboarded;

class LogEmployeeOnboardedEvent
{
    public function handle(Onboarded $event)
    {
        activity()
            ->performedOn($event->employee)
            ->log(__('jinzai::filament/resources/onboarding-link.events.onboarded'))
        ;
    }
}
