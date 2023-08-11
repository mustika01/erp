<?php

namespace Kumi\Kanri\Events\Ticket;

use Kumi\Kanri\Models\Ticket;
use Illuminate\Foundation\Events\Dispatchable;

class SalaryAdvanceTicketApproved
{
    use Dispatchable;

    public function __construct(
        public Ticket $ticket
    ) {
    }
}
