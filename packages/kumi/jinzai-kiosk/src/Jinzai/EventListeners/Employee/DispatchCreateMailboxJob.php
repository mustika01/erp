<?php

namespace Kumi\Jinzai\EventListeners\Employee;

use Kumi\Jinzai\Jobs\CreateMailboxJob;
use Kumi\Jinzai\Events\Employee\Created;

class DispatchCreateMailboxJob
{
    public function handle(Created $event): void
    {
        CreateMailboxJob::dispatch($event->employee->email);
    }
}
