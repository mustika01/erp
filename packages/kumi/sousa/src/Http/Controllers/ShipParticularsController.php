<?php

namespace Kumi\Sousa\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Kumi\Sousa\Models\Vessel;
use Spatie\Browsershot\Browsershot;

class ShipParticularsController
{
    public function preview(Vessel $vessel)
    {
        return view('sousa::ship-particulars.preview', [
            'vessel' => $vessel,
            'properties' => $vessel->properties,
        ]);
    }

    public function download(Vessel $vessel)
    {
        $margin = 4;

        Browsershot::url(route('sousa.ship-particulars.preview', [$vessel]))
            // ->setNodeBinary(config('browsershot.node_binary_path'))
            // ->setNpmBinary(config('browsershot.npm_binary_path'))
            ->noSandbox()
            ->showBackground()
            ->margins($margin, $margin, $margin, $margin)
            ->format('A4')
            ->savePdf($tmpFilePath = storage_path('temp/' . Str::uuid() . '.pdf'))
        ;

        $fileName = "{$vessel->name} - Ship Particulars.pdf";

        return Response::download($tmpFilePath, $fileName);
    }
}
