<?php

namespace Kumi\Kiosk\Actions;

use Illuminate\Support\Str;
use Kumi\Kiosk\Support\Enums\LoanPeriod;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateMonthyInstallmentAmount
{
    use AsAction;

    public function handle(?string $loanAmount, ?string $loanPeriod): string
    {
        if (empty($loanAmount) || is_null($loanAmount)) {
            return 0;
        }

        if (empty($loanPeriod) || is_null($loanPeriod)) {
            return 0;
        }

        $period = Str::before($loanPeriod, LoanPeriod::BEFORE_MONTHS);

        $loanAmount = (int) $loanAmount;
        $period = (int) $period;

        return round($loanAmount / $period, -4);
    }
}
