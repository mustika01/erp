<?php

namespace Kumi\Jinzai\EventListeners;

use Kumi\Tobira\Events\User\PasswordUpdated;
use Kumi\Jinzai\Jobs\UpdateMailboxPasswordJob;

class DispatchUpdateMailboxPasswordJob
{
    public function handle(PasswordUpdated $event): void
    {
        UpdateMailboxPasswordJob::dispatch($event->user->email, $event->password);
    }
}
