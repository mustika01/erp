<?php

namespace Kumi\Norikumi\EventSubscribers;

use Kumi\Norikumi\EventListeners\Loan\InitializeLoanPayments;
use Kumi\Norikumi\EventListeners\Loan\LinkOldestLoanPaymentToPayoutItem;
use Kumi\Norikumi\EventListeners\Loan\LogLoanApprovedEvent;
use Kumi\Norikumi\Events\Loan\Approved;

class LoanEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Approved::class => [
                InitializeLoanPayments::class,
                LinkOldestLoanPaymentToPayoutItem::class,
                LogLoanApprovedEvent::class,
            ],
        ];
    }
}
