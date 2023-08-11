<?php

namespace Kumi\Norikumi\Actions;

use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateDepositAmountFinalDate
{
    use AsAction;

    public function handle(\Closure $get, \Closure $set)
    {
        $startDate = $get('started_at');
        $depositAmount = $get('deposit_amount');
        $installmentAmount = $get('installment_amount');

        if (
            is_null($startDate)
            || is_null($depositAmount)
            || is_null($installmentAmount)
            || $startDate == ''
            || $depositAmount == ''
            || $installmentAmount == ''
            || $depositAmount == 0
            || $installmentAmount == 0
        ) {
            return;
        }

        $monthCount = ceil($depositAmount / $installmentAmount);
        $startDate = Carbon::parse($startDate)->startOfMonth()->startOfDay();
        $finalDate = $startDate->copy()->addMonth($monthCount)->subDay()->endOfMonth()->endOfDay();

        $set('finalized_at', $finalDate->toDateString());
    }
}
