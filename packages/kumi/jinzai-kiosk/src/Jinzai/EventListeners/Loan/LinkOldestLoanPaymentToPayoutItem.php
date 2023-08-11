<?php

namespace Kumi\Jinzai\EventListeners\Loan;

use NumberFormatter;
use Kumi\Jinzai\Models\PayoutItem;
use Kumi\Jinzai\Events\Loan\Approved;

class LinkOldestLoanPaymentToPayoutItem
{
    public function handle(Approved $event)
    {
        $loan = $event->loan;
        $payment = $loan->oldestPayment;
        $payout = $loan->payroll->latestPayout;

        if ($payout && ($loan->isActive() || $loan->isActiveAgainstPayout($payout))) {
            $formatter = new NumberFormatter('en_US', NumberFormatter::ORDINAL);
            $sequence = $formatter->format($payment->sequence);

            $item = new PayoutItem([
                'type' => PayoutItem::TYPE_LOAN,
                'description' => "Loan Payment ({$sequence} of {$payment->total_sequence})",
                'amount' => $payment->amount * -1,
            ]);

            $item->relatable()->associate($payment);

            $payout->items()->save($item);
        }
    }
}
