<?php

namespace Kumi\Norikumi\EventListeners\Assignment;

use Illuminate\Support\Carbon;
use Kumi\Norikumi\Events\Assignment\Retracted;
use Kumi\Norikumi\Models\PayoutItem;

class CheckForRetractedDate
{
    public function handle(Retracted $event)
    {
        $assignment = $event->assignment;
        $crew = $assignment->crew;
        $payroll = $crew->payroll;
        $latestPayout = $payroll->latestPayout;
        $salary = $payroll->salary;

        $inactiveDays = 30 - Carbon::now()->day;

        $retractedAdjustment = round($salary / 30 * $inactiveDays, -3);

        $latestPayout->items()->save(
            $item = new PayoutItem([
                'type' => PayoutItem::TYPE_RETRACTED_ADJUSTMENT,
                'description' => "Salary Adjustment ({$inactiveDays} days)",
                'amount' => $retractedAdjustment * -1,
            ])
        );

        $payroll->markAsDeactivated();
    }
}
