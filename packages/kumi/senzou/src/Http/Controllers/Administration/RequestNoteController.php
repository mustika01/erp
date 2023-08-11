<?php

namespace Kumi\Senzou\Http\Controllers\Administration;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Kumi\Senzou\Models\RequestNote;
use Spatie\Browsershot\Browsershot;

class RequestNoteController
{
    public function preview(RequestNote $record)
    {
        return view('senzou::request-notes.administration.preview', [
            'requestNote' => $record,
        ]);
    }

    public function download(RequestNote $record)
    {
        $margin = 4;

        Browsershot::url(route('senzou.request-notes.preview', [$record]))
            // ->setNodeBinary(config('browsershot.node_binary_path'))
            // ->setNpmBinary(config('browsershot.npm_binary_path'))
            ->noSandbox()
            ->showBackground()
            ->margins($margin, $margin, $margin, $margin)
            ->format('A4')
            ->savePdf($tmpFilePath = storage_path('temp/' . Str::uuid() . '.pdf'))
        ;

        $fileName = "{$record->user->vessel->name} - Request Notes.pdf";

        return Response::download($tmpFilePath, $fileName);
    }
}
