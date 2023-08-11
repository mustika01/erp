<?php

namespace Kumi\Sousa\Http\Controllers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Kumi\Sousa\Models\VesselDocument;
use Spatie\Browsershot\Browsershot;

class ExpiringDocumentsController
{
    public function preview()
    {
        $nextMonth = Carbon::now()->startOfMonth()->addMonth()->endOfMonth()->endOfDay();

        $documents = VesselDocument::query()
            ->with(['vessel'])
            ->where('expired_at', '<=', $nextMonth)
            ->oldest('expired_at')
            ->get()
        ;

        return view('sousa::expiring-documents.preview', [
            'columns' => [
                'No.',
                'Endorse Finish',
                'Expiry Date',
                'Document Name',
                'Vessel',
                'Remarks',
            ],
            'documents' => $documents,
        ]);
    }

    public function download()
    {
        $margin = 4;

        Browsershot::url(route('sousa.expiring-documents.preview'))
            // ->setNodeBinary(config('browsershot.node_binary_path'))
            // ->setNpmBinary(config('browsershot.npm_binary_path'))
            ->noSandbox()
            ->showBackground()
            ->margins($margin, $margin, $margin, $margin)
            ->format('A4')
            ->savePdf($tmpFilePath = storage_path('temp/' . Str::uuid() . '.pdf'))
        ;

        $fileName = "List of Vessels' Expiring Documents.pdf";

        return Response::download($tmpFilePath, $fileName);
    }
}
