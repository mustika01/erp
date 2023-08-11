<?php

namespace Kumi\Senzou\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Kumi\Senzou\Models\DeliveryNoteEntry;
use Spatie\Browsershot\Browsershot;

class DeliveryNoteDailyReportController
{
    public function preview(Request $request)
    {
        $date = $request->get('date');

        $entries = DeliveryNoteEntry::query()
            ->whereHas('note', function ($query) use ($date) {
                $query->whereDate('date', $date);
            })->get()
        ;

        return view('senzou::delivery-note-daily-report.preview-delivery-note-daily-report', [
            'entries' => $entries,
        ]);
    }

    public function download(Request $request)
    {
        $date = $request->get('date');

        $margin = 4;

        Browsershot::url(route('senzou.delivery-note-daily-report.preview', $request->only(['date'])))
            // ->setNodeBinary(config('browsershot.node_binary_path'))
            // ->setNpmBinary(config('browsershot.npm_binary_path'))
            ->noSandbox()
            ->showBackground()
            ->margins($margin, $margin, $margin, $margin)
            ->format('A4')
            ->savePdf($tmpFilePath = storage_path('temp/' . Str::uuid() . '.pdf'))
        ;

        $fileName = "{$date} - Delivery Note Daily Report.pdf";

        return Response::download($tmpFilePath, $fileName);
    }
}
