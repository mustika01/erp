<?php

namespace Kumi\Jinzai\EventSubscribers;

use Kumi\Jinzai\Events\Loan\Approved;
use Kumi\Jinzai\EventListeners\Loan\LogLoanApprovedEvent;
use Kumi\Jinzai\EventListeners\Loan\InitializeLoanPayments;
use Kumi\Jinzai\EventListeners\Loan\LinkOldestLoanPaymentToPayoutItem;

class LoanEventSubscriber
{
    public function subscribe($events): array
    {
        return [
            Approved::class => [
                LogLoanApprovedEvent::class,
                InitializeLoanPayments::class,
                LinkOldestLoanPaymentToPayoutItem::class,
            ],
        ];
    }
}
