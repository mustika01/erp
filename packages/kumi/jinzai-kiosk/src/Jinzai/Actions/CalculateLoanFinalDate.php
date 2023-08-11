<?php

namespace Kumi\Jinzai\Actions;

use Closure;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateLoanFinalDate
{
    use AsAction;

    public function handle(Closure $get, Closure $set)
    {
        $startDate = $get('started_at');
        $loanAmount = $get('loan_amount');
        $installmentAmount = $get('installment_amount');

        if (
            is_null($startDate)
            || is_null($loanAmount)
            || is_null($installmentAmount)
            || $startDate == ''
            || $loanAmount == ''
            || $installmentAmount == ''
            || $loanAmount == 0
            || $installmentAmount == 0
        ) {
            return;
        }

        $monthCount = ceil($loanAmount / $installmentAmount);
        $startDate = Carbon::parse($startDate)->startOfMonth()->startOfDay();
        $finalDate = $startDate->copy()->addMonth($monthCount)->subDay()->endOfMonth()->endOfDay();

        $set('finalized_at', $finalDate->toDateString());
    }
}
