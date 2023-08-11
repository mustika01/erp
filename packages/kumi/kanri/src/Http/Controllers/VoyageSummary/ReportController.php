<?php

namespace Kumi\Kanri\Http\Controllers\VoyageSummary;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Kumi\Kanri\Models\Report;
use Kumi\Sousa\Models\VesselVoyage;
use Spatie\Browsershot\Browsershot;

class ReportController
{
    use AuthorizesRequests;

    public function preview(Report $report): ViewContract
    {
        return view('kanri::report.voyage-summary.preview', $this->getViewData($report));
    }

    public function download(Report $report)
    {
        $date = $report->started_at->format('M Y');
        $margin = 4;

        Browsershot::url(route('reports.voyage-summary.preview', [$report]))
            // ->setNodeBinary(config('browsershot.node_binary_path'))
            // ->setNpmBinary(config('browsershot.npm_binary_path'))
            ->noSandbox()
            ->showBackground()
            ->margins($margin, $margin, $margin, $margin)
            ->format('A4')
            ->savePdf($tmpFilePath = storage_path('temp/' . Str::uuid() . '.pdf'))
        ;

        $fileName = "{$date} - Report Voyage Summary.pdf";

        return Response::download($tmpFilePath, $fileName);
    }

    protected function getViewData(Report $report): array
    {
        $voyages = VesselVoyage::query()
            ->whereHas('statuses', function (Builder $query) use ($report) {
                $query
                    ->where('description', 'finish-loading')
                    ->whereBetween('executed_at', [$report->started_at, $report->finalized_at])
                ;
            })
            ->get()
        ;

        $groupVessels = $voyages->groupBy(function (VesselVoyage $voyage) {
            return $voyage->vessel->name;
        });

        $totalVoyage = VesselVoyage::query()
            ->whereHas('statuses', function (Builder $query) use ($report) {
                $query
                    ->whereBetween('executed_at', [$report->started_at, $report->finalized_at])
                ;
            })->count()
        ;

        return [
            'company' => 'PT. Lintas Bahari Nusantara',
            'title' => __('kanri::reports/voyage-summary.title', ['period' => $report->started_at->format('M Y')]),
            'columns' => [
                'No.',
                'Vessel',
                'Voyage No',
                'Origin',
                'Destination',
                'Cargo Content',
                'Tonnage Amount',
            ],
            'voyages' => $voyages,
            'groupVessels' => $groupVessels,
            'totalVoyage' => $totalVoyage,
        ];
    }
}
