<?php

namespace Kumi\Norikumi\EventListeners\Payroll;

use Kumi\Norikumi\Actions\CalculateInitialSalaryAdjustment;
use Kumi\Norikumi\Events\Payroll\Activated;
use Kumi\Norikumi\Models\Payout;
use Kumi\Norikumi\Models\PayoutItem;

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
        $payout->initializePayoutItemForDepositPayment();

        [$days, $adjustment] = CalculateInitialSalaryAdjustment::run(
            $payroll->activated_at->startOfDay(),
            $payroll->activated_at->endOfDay()->endOfMonth(),
            $payroll->salary
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
