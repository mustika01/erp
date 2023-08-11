<?php

namespace Kumi\Norikumi\EventListeners\Deposit;

use Illuminate\Support\Collection;
use Kumi\Norikumi\Events\Deposit\Approved;
use Kumi\Norikumi\Models\DepositPayment;

class InitializeDepositPayments
{
    public function handle(Approved $event)
    {
        $deposit = $event->deposit;
        $depositAmount = $deposit->getAttribute('deposit_amount');
        $installmentAmount = $deposit->getAttribute('installment_amount');

        $remainderAmount = $depositAmount % $installmentAmount;

        if ($remainderAmount === 0) {
            $times = $depositAmount / $installmentAmount;
        } else {
            $times = floor($depositAmount / $installmentAmount);
        }

        $paymentDate = $deposit->started_at->startOfMonth()->startOfDay();

        Collection::times($times, function () use ($deposit, $installmentAmount, $paymentDate) {
            $payment = new DepositPayment([
                'amount' => $installmentAmount,
                'paid_at' => $paymentDate->copy()->endOfMonth()->endOfDay(),
            ]);

            $deposit->payments()->save($payment);

            $paymentDate->addMonth();
        });

        if ($remainderAmount > 0) {
            $payment = new DepositPayment([
                'amount' => $remainderAmount,
                'paid_at' => $paymentDate->copy()->endOfMonth()->endOfDay(),
            ]);

            $deposit->payments()->save($payment);
        }

        $payments = $deposit->payments->sortBy('paid_at');

        $payments->each(function (DepositPayment $payment, $index) use ($payments) {
            $payment->update([
                'sequence' => $index + 1,
                'total_sequence' => $payments->count(),
            ]);
        });
    }
}
