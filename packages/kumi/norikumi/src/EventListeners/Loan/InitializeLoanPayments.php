<?php

namespace Kumi\Norikumi\EventListeners\Loan;

use Illuminate\Support\Collection;
use Kumi\Norikumi\Events\Loan\Approved;
use Kumi\Norikumi\Models\LoanPayment;

class InitializeLoanPayments
{
    public function handle(Approved $event)
    {
        $loan = $event->loan;
        $loanAmount = $loan->getAttribute('loan_amount');
        $installmentAmount = $loan->getAttribute('installment_amount');

        $remainderAmount = $loanAmount % $installmentAmount;

        if ($remainderAmount === 0) {
            $times = $loanAmount / $installmentAmount;
        } else {
            $times = floor($loanAmount / $installmentAmount);
        }

        $paymentDate = $loan->started_at->startOfMonth()->startOfDay();

        Collection::times($times, function () use ($loan, $installmentAmount, $paymentDate) {
            $payment = new LoanPayment([
                'amount' => $installmentAmount,
                'paid_at' => $paymentDate->copy()->endOfMonth()->endOfDay(),
            ]);

            $loan->payments()->save($payment);

            $paymentDate->addMonth();
        });

        if ($remainderAmount > 0) {
            $payment = new LoanPayment([
                'amount' => $remainderAmount,
                'paid_at' => $paymentDate->copy()->endOfMonth()->endOfDay(),
            ]);

            $loan->payments()->save($payment);
        }

        $payments = $loan->payments->sortBy('paid_at');

        $payments->each(function (LoanPayment $payment, $index) use ($payments) {
            $payment->update([
                'sequence' => $index + 1,
                'total_sequence' => $payments->count(),
            ]);
        });
    }
}
