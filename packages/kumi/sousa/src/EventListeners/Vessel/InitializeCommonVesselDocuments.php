<?php

namespace Kumi\Sousa\EventListeners\Vessel;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Events\Vessel\Created;
use Kumi\Sousa\Models\VesselDocument;

class InitializeCommonVesselDocuments
{
    public function handle(Created $event)
    {
        $documents = Collection::make($this->getCommonVesselDocuments())
            ->map(function (array $attributes) {
                $attributes['slug'] = Str::slug($attributes['name']);
                $attributes['issued_at'] = Carbon::now();
                $attributes['endorse_period_finished_at'] = Carbon::now();
                $attributes['expired_at'] = Carbon::now();

                return new VesselDocument($attributes);
            })
        ;

        $event->vessel->documents()->saveMany($documents);
    }

    protected function getCommonVesselDocuments(): array
    {
        return [
            [
                'name' => 'Surat Ukur',
            ],
            [
                'name' => 'Surat Laut',
            ],
            [
                'name' => 'Sertifikat Keselamatan Konstruksi Kapal Barang',
            ],
            [
                'name' => 'Sertifikat Keselamatan Perlengkapan Kapal Barang',
            ],
            [
                'name' => 'Sertifikat Keselamatan Radio Kapal Barang',
            ],
            [
                'name' => 'Sertifikat Pencegahan Penyemaran Radio Kapal Barang',
            ],
            [
                'name' => 'Sertifikat BKI - Lambung',
            ],
            [
                'name' => 'Sertifikat BKI - Mesin',
            ],
            [
                'name' => 'Sertifikat BKI - Garis Muat',
            ],
            [
                'name' => 'Sertifikat Safe Manning',
                'description' => 'Sertifikat Keselamatan Pengawakan Minimum',
            ],
            [
                'name' => 'Sertifikat Derrating / Ship Sanitation',
            ],
            [
                'name' => 'Asuransi WRI / WRP',
            ],
            [
                'name' => 'Sertifikat Safety Management',
                'description' => 'Sertifikat Management Kesehatan',
            ],
            [
                'name' => 'Sertifikat Document of Compliance',
            ],
            [
                'name' => 'Sertifikat Anti Teritip',
            ],
            [
                'name' => 'Sertifikat Liferaft',
            ],
            [
                'name' => 'Sertifikat Fire Extinguisher',
            ],
            [
                'name' => 'Sertifikat CLC Bunker',
                'description' => 'Sertifikat Dana Jaminan Ganti Rugi Pencemaran Minyak',
            ],
            [
                'name' => 'Rencana Pengelolaan Trayek',
            ],
            [
                'name' => 'Izin Stasiun Radio Kapal',
            ],
        ];
    }
}
