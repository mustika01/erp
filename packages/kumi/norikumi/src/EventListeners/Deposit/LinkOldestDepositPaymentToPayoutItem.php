<?php

namespace Kumi\Norikumi\EventListeners\Deposit;

use Kumi\Norikumi\Events\Deposit\Approved;
use Kumi\Norikumi\Models\PayoutItem;

class LinkOldestDepositPaymentToPayoutItem
{
    public function handle(Approved $event)
    {
        $deposit = $event->deposit;
        $payment = $deposit->oldestPayment;
        $payout = $deposit->payroll->latestPayout;

        if ($payout && ($deposit->isActive() || $deposit->isActiveAgainstPayout($payout))) {
            $formatter = new \NumberFormatter('en_US', \NumberFormatter::ORDINAL);
            $sequence = $formatter->format($payment->sequence);

            $item = new PayoutItem([
                'type' => PayoutItem::TYPE_DEPOSIT_ON_HOLD,
                'description' => "Deposit Payment ({$sequence} of {$payment->total_sequence})",
                'amount' => $payment->amount * -1,
            ]);

            $item->relatable()->associate($payment);

            $payout->items()->save($item);
        }
    }
}
