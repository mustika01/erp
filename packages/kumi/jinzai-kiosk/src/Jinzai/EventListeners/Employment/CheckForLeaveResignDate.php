<?php

namespace Kumi\Jinzai\EventListeners\Employment;

use Illuminate\Support\Collection;
use Kumi\Jinzai\Events\Employment\Updated;

class CheckForLeaveResignDate
{
    public function handle(Updated $event)
    {
        $changes = Collection::make($event->employment->getChanges());

        if ($changes->has('left_at') || $changes->has('resigned_at')) {
            $event->employment->employee->payroll->markAsDeactivated();
            $event->employment->employee->user->markUserAsInactive();
        }
    }
}
