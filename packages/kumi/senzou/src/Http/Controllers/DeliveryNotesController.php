<?php

namespace Kumi\Senzou\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Kumi\Senzou\Models\DeliveryNote;
use Spatie\Browsershot\Browsershot;

class DeliveryNotesController
{
    public function preview(DeliveryNote $record)
    {
        return view('senzou::delivery-notes.preview', [
            'deliveryNote' => $record,
        ]);
    }

    public function download(DeliveryNote $record)
    {
        $margin = 4;

        Browsershot::url(route('senzou.delivery-notes.preview', [$record]))
            // ->setNodeBinary(config('browsershot.node_binary_path'))
            // ->setNpmBinary(config('browsershot.npm_binary_path'))
            ->noSandbox()
            ->showBackground()
            ->margins($margin, $margin, $margin, $margin)
            ->format('A4')
            ->savePdf($tmpFilePath = storage_path('temp/' . Str::uuid() . '.pdf'))
        ;

        $fileName = "{$record->vessel->name} - Delivery Notes.pdf";

        return Response::download($tmpFilePath, $fileName);
    }
}
