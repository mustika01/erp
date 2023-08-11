<?php

namespace Kumi\Kanri\Http\Controllers\DockingSchedule;

use Illuminate\Http\Response;
use Kumi\Kanri\Models\Report;
use Kumi\Sousa\Models\Vessel;
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
            || Auth::user()->can(DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS);

        abort_unless($report->reportable_type === 'docking-schedule', Response::HTTP_NOT_FOUND);
        abort_unless($allowed, Response::HTTP_UNAUTHORIZED);

        return View::make('kanri::report.docking-schedule.preview', $this->getViewData($report));
    }

    protected function getViewData(Report $report): array
    {
        $vessels = Vessel::query()
            ->whereBetween('properties->next_docked_at', [$report->started_at, $report->finalized_at])
            ->get()
        ;

        return [
            'company' => 'PT. Lintas Bahari Nusantara',
            'title' => __('kanri::reports/docking-schedule.title', ['period' => $report->started_at->format('Y')]),
            'columns' => [
                'No.',
                'Vessel',
                'Last Docking Date',
                'Next Docking Date',
            ],
            'vessels' => $vessels,
        ];
    }
}
