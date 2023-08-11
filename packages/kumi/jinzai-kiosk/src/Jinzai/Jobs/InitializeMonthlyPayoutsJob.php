<?php

namespace Kumi\Jinzai\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Models\Payroll;

class InitializeMonthlyPayoutsJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Payroll::query()
            ->onlyActivated()
            ->get()
            ->each(function (Payroll $payroll) {
                if ($payroll->isLatestPayoutExpired()) {
                    $now = Carbon::now();

                    $payout = Payout::create([
                        'payroll_id' => $payroll->id,
                        'description' => 'Salary Payout - ' . $now->format('F Y'),
                        'started_at' => $now->copy()->startOfMonth()->startOfDay(),
                        'finalized_at' => $now->copy()->endOfMonth()->endOfDay(),
                    ]);

                    $payout->initializeMonthlyPayoutItems();
                    $payout->initializePayoutItemForLoanPayment();
                }
            })
        ;
    }
}
