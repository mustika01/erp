<?php

namespace Kumi\Jinzai\EventListeners\Payroll;

use Kumi\Jinzai\Actions\CalculateInitialSalaryAdjustment;
use Kumi\Jinzai\Events\Payroll\Activated;
use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Models\PayoutItem;

class InitializeSalaryPayout
{
    public function handle(Activated $event)
    {
        $payroll = $event->payroll;

        $payout = Payout::create([
            'payroll_id' => $payroll->id,
            'description' => 'Salary Payout - ' . $payroll->activated_at->format('F Y'),
            'started_at' => $payroll->activated_at->startOfDay(),
            'finalized_at' => $payroll->activated_at->endOfDay()->endOfMonth(),
        ]);

        $payout->initializeMonthlyPayoutItems();
        $payout->initializePayoutItemForLoanPayment();

        [$days, $adjustment] = CalculateInitialSalaryAdjustment::run(
            $payroll->activated_at->startOfDay(),
            $payroll->activated_at->endOfDay()->endOfMonth(),
            $payroll->salary + $payroll->job_allowance,
        );

        if ($days === 0) {
            return;
        }

        $payout->items()->save(
            new PayoutItem([
                'type' => PayoutItem::TYPE_INITIAL_ADJUSTMENT,
                'description' => "Initial Salary Adjustment ({$days} days)",
                'amount' => $adjustment * -1,
                'properties' => [
                    'days_count' => $days,
                ],
            ])
        );
    }
}
