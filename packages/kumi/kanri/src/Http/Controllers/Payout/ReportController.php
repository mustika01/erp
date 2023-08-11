<?php

namespace Kumi\Kanri\Http\Controllers\Payout;

use Illuminate\Http\Response;
use Kumi\Kanri\Models\Report;
use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Models\Approval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Kumi\Kanri\Support\DefaultPermissions;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReportController
{
    use AuthorizesRequests;

    public function preview(Report $report): ViewContract
    {
        $allowed = Auth::user()->can(DefaultPermissions::VIEW_ANY_REPORTS)
            || Auth::user()->can(DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS);

        abort_unless($report->reportable_type === \Kumi\Jinzai\Models\Payout::class, Response::HTTP_NOT_FOUND);
        abort_unless($allowed, Response::HTTP_UNAUTHORIZED);

        return View::make('kanri::report.payout.preview', $this->getViewData($report));
    }

    protected function getViewData(Report $report): array
    {
        $startDate = $report->started_at;
        $finalDate = $report->finalized_at;

        $payouts = Payout::query()->dateBetween($startDate, $finalDate)->get();
        $approvals = $payouts
            ->sortByDesc(function ($payout) {
                return $payout->approvals->count();
            })
            ->first()
            ->approvals
            ->mapWithKeys(function (Approval $approval) {
                return [$approval->user_id => $approval->user->name];
            })
        ;

        $groupedPayouts = $payouts->groupBy(function (Payout $payout) {
            return $payout->payroll->employee->department;
        })->mapWithKeys(function ($value, $key) {
            return [$key => $value->sortByDesc('base_amount')];
        });

        $hasViewReportBreakDownPermission = Auth::user()->can(DefaultPermissions::VIEW_REPORT)
            || Auth::user()->can(DefaultPermissions::VIEW_PAYOUT_REPORT_BREAKDOWN);

        return [
            'company' => 'PT. Lintas Bahari Nusantara',
            'title' => __('kanri::reports/payout.title', ['period' => $report->started_at->format('F Y')]),
            'columns' => [
                'No.',
                'Name',
                'Position',
                'Base Salary',
                'Allowance',
                'Loan',
                'Adjustment',
                'THP',
                'Approvals',
            ],
            'base_payout' => number_format($payouts->sum('base_amount')),
            'job_allowance_payout' => number_format($payouts->sum('job_allowance_amount')),
            'loan_payout' => number_format($payouts->sum('loan_amount')),
            'adjustment_payout' => number_format($payouts->sum('adjustment_amount')),
            'take_home_pay_payout' => number_format($payouts->sum('take_home_pay_amount')),
            'employee_payout' => $payouts->count(),
            // 'payouts' => $payouts,
            'groupedPayouts' => $groupedPayouts,
            'approvals' => $approvals,

            'hasViewReportBreakDownPermission' => $hasViewReportBreakDownPermission,
        ];
    }
}
