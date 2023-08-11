<?php

namespace Kumi\Jinzai\Actions;

use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Models\PayoutItem;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateSalaryAdjustment
{
    use AsAction;

    public function handle(array $data, Payout $payout): array
    {
        if ($data['type'] == PayoutItem::TYPE_ADJUSTMENT) {
            $salary = $payout->payroll->salary + $payout->payroll->job_allowance ?? 0;
            $daysInMonth = $payout->finalized_at->daysInMonth;

            $daysCount = $data['days_count'];
            $absoluteDaysCount = abs($daysCount);

            $data['description'] = "Salary Adjustment ({$absoluteDaysCount} days)";
            $data['amount'] = round($daysCount / $daysInMonth * $salary, -3);
            $data['properties']['days_count'] = $absoluteDaysCount;

            unset($data['days_count']);
        }

        return $data;
    }
}
