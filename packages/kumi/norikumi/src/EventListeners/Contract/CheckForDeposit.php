<?php

namespace Kumi\Norikumi\EventListeners\Contract;

use Kumi\Norikumi\Events\Contract\Created;
use Kumi\Norikumi\Models\PayoutItem;

class CheckForDeposit
{
    public function handle(Created $event)
    {
        $contract = $event->contract;

        $crew = $contract->crew;

        $payroll = $crew->payroll;

        if (! $payroll) {
            return;
        }

        $deposit = $payroll->latestDeposit;

        if (! $deposit) {
            return;
        }

        if ($deposit->isActive()) {
            return;
        }

        if (! $crew->hasLatestInactiveContract()) {
            return;
        }

        $hasActiveContract = $crew->hasActiveContract();
        $hasLatestInactiveContract = $crew->hasLatestInactiveContract();
        $hasInactiveDeposit = ! $deposit->isActive();
        $hasApproveDeposit = $deposit->isApproved();
        $hasValidContract = $crew->latestInactiveContract->ended_at->diffInHours($contract->started_at) <= 24;
        $hasCompletedDeposit = $deposit->isCompleted();

        if ($hasActiveContract
            && $hasLatestInactiveContract
            && $hasInactiveDeposit
            && $hasApproveDeposit
            && $hasValidContract
            && $hasCompletedDeposit) {
            $totaldeposit = $deposit->deposit_amount;
            $payout = $crew->payroll->latestPayout;

            $payout->items()->save(
                $item = new PayoutItem([
                    'type' => PayoutItem::TYPE_DEPOSIT_RETURNED,
                    'description' => 'Total Deposit',
                    'amount' => $totaldeposit,
                ])
            );
        }
    }
}
