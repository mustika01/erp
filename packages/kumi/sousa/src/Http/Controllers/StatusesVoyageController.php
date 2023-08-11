<?php

namespace Kumi\Sousa\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Kumi\Sousa\Models\BunkerJournal;
use Kumi\Sousa\Models\BunkerJournalEntry;
use Kumi\Sousa\Models\OilJournal;
use Kumi\Sousa\Models\OilJournalEntry;
use Kumi\Sousa\Models\VesselVoyage;
use Spatie\Browsershot\Browsershot;

class StatusesVoyageController
{
    use AuthorizesRequests;

    public function preview(VesselVoyage $record): ViewContract
    {
        // dd($record->loadingCargoLogs);
        // $allowed = Auth::user()->can(DefaultPermissions::VIEW_ANY_REPORTS)
        // || Auth::user()->can(DefaultPermissions::VIEW_ANY_VOYAGE_SUMMARY_REPORTS);

        // abort_unless($report->reportable_type === \Kumi\Sousa\Models\VesselVoyage::class, HttpResponse::HTTP_NOT_FOUND);
        // abort_unless($allowed, HttpResponse::HTTP_UNAUTHORIZED);

        return View::make('sousa::statuses-voyage.preview', $this->getViewData($record));
    }

    public function download(VesselVoyage $record)
    {
        $vessel = $record->vessel->name;
        $voyagenumber = $record->number;
        $margin = 4;

        Browsershot::url(route('sousa.statuses-voyage.preview', [$record]))
            // ->setNodeBinary(config('browsershot.node_binary_path'))
            // ->setNpmBinary(config('browsershot.npm_binary_path'))
            ->noSandbox()
            ->showBackground()
            ->margins($margin, $margin, $margin, $margin)
            ->format('A4')
            ->savePdf($tmpFilePath = storage_path('temp/' . Str::uuid() . '.pdf'))
        ;

        $fileName = "{$vessel} Voyage No:{$voyagenumber} - Report Statuses Voyage.pdf";

        return Response::download($tmpFilePath, $fileName);
    }

    protected function getViewData(VesselVoyage $record): array
    {
        $loading = $record->loadingCargoLogs;
        $unLoading = $record->unloadingCargoLogs;

        $statuses = $record->statuses->sortBy('executed_at');

        $startDate = $statuses->first()->executed_at;
        $finalDate = $statuses->last()->executed_at;

        $bunkerUsage = BunkerJournalEntry::query()
            ->whereHas('journal', function (Builder $query) use ($record, $startDate, $finalDate) {
                $query
                    ->whereBetween('date', [$startDate, $finalDate])
                    ->whereHas('bunker', function (Builder $query) use ($record) {
                        $query->where('vessel_id', $record->vessel_id);
                    })
                ;
            })->get()
        ;

        $bunkerROB = BunkerJournal::query()
            ->whereBetween('date', [$startDate, $finalDate])
            ->whereHas('bunker', function (Builder $query) use ($record) {
                $query->where('vessel_id', $record->vessel_id);
            })->latest()->first()
        ;

        $oilUsage90 = OilJournalEntry::query()->where('entry_type', 'usage')->where('oil_type', 'type_90')
            ->whereHas('journal', function (Builder $query) use ($record, $startDate, $finalDate) {
                $query
                    ->whereBetween('date', [$startDate, $finalDate])
                    ->whereHas('bunker', function (Builder $query) use ($record) {
                        $query->where('vessel_id', $record->vessel_id);
                    })
                ;
            })->get()
        ;

        $oilROB90 = OilJournal::query()
            ->whereBetween('date', [$startDate, $finalDate])
            ->whereHas('bunker', function (Builder $query) use ($record) {
                $query->where('vessel_id', $record->vessel_id);
            })->latest()->first()
        ;

        $oilUsage40 = OilJournalEntry::query()->where('entry_type', 'usage')->where('oil_type', 'type_40')
            ->whereHas('journal', function (Builder $query) use ($record, $startDate, $finalDate) {
                $query
                    ->whereBetween('date', [$startDate, $finalDate])
                    ->whereHas('bunker', function (Builder $query) use ($record) {
                        $query->where('vessel_id', $record->vessel_id);
                    })
                ;
            })->get()
        ;

        $oilROB40 = OilJournal::query()
            ->whereBetween('date', [$startDate, $finalDate])
            ->whereHas('bunker', function (Builder $query) use ($record) {
                $query->where('vessel_id', $record->vessel_id);
            })->latest()->first()
        ;

        $oilUsage10 = OilJournalEntry::query()->where('entry_type', 'usage')->where('oil_type', 'type_10')
            ->whereHas('journal', function (Builder $query) use ($record, $startDate, $finalDate) {
                $query
                    ->whereBetween('date', [$startDate, $finalDate])
                    ->whereHas('bunker', function (Builder $query) use ($record) {
                        $query->where('vessel_id', $record->vessel_id);
                    })
                ;
            })->get()
        ;

        $oilROB10 = OilJournal::query()
            ->whereBetween('date', [$startDate, $finalDate])
            ->whereHas('bunker', function (Builder $query) use ($record) {
                $query->where('vessel_id', $record->vessel_id);
            })->latest()->first()
        ;

        return [
            'company' => 'PT. Lintas Bahari Nusantara',
            'title' => __('sousa::filament/resources/voyage-status.actions.title.label'),
            'columns' => [
                'No ',
                'Date',
                'Time',
                'Description',
                'Remarks',
            ],
            'voyage' => $record,
            'statuses' => $statuses,
            'bunkerUsage' => number_format($bunkerUsage->sum('total_usage')),
            'bunkerROB' => number_format($bunkerROB->rob_amount),
            'oilUsage90' => number_format($oilUsage90->sum('total_litre')),
            'oilROB90' => number_format($oilROB90->rob_amount_type_90),
            'oilUsage40' => number_format($oilUsage40->sum('total_litre')),
            'oilROB40' => number_format($oilROB40->rob_amount_type_40),
            'oilUsage10' => number_format($oilUsage10->sum('total_litre')),
            'oilROB10' => number_format($oilROB10->rob_amount_type_10),
            'loading' => number_format($loading->sum('tonnage_amount')),
            'unLoading' => number_format($unLoading->sum('tonnage_amount')),
        ];
    }
}
