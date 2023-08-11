<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets;

use Illuminate\Support\Arr;
use Filament\Widgets\Widget;
use Kumi\Sousa\Models\Vessel;
use Illuminate\Support\Collection;

class VesselLocationWidget extends Widget
{
    public ?Vessel $vessel = null;

    public Collection $icons;

    protected static string $view = 'sousa::filament.widgets.vessel-location-widget';

    public function mount(): void
    {
        $this->icons = Collection::times(361, function ($index) {
            $angle = $index - 1;

            return asset("/images/direction/output/dir-{$angle}.png");
        });
    }

    protected function hasLatestTrack(): bool
    {
        return ! is_null($this->vessel->latestTrack);
    }

    protected function getStaticMapUrl(): string
    {
        $baseUrl = 'https://maps.googleapis.com/maps/api/staticmap';

        $latitude = optional($this->vessel->latestTrack)->latitude;
        $longitude = optional($this->vessel->latestTrack)->longitude;

        $parameters = Arr::query([
            'center' => "{$latitude},{$longitude}",
            'zoom' => 6,
            'size' => '600x400',
            'markers' => implode('|', [
                "icon:{$this->icons[$this->vessel->latestTrack->cardinal_angle]}",
                "{$latitude},{$longitude}",
            ]),
            'key' => config('services.google.maps.key'),
        ]);

        return "{$baseUrl}?{$parameters}";
    }
}
