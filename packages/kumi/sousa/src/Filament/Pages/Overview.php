<?php

namespace Kumi\Sousa\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Http\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Support\DefaultPermissions;

class Overview extends Page
{
    public Collection $windows;
    public Collection $markers;
    public Collection $vessels;
    public Collection $selectedVessels;
    public Collection $icons;
    public ?int $selectedVesselID = null;

    protected static string $layout = 'sousa::layouts.overview';

    protected static ?string $navigationGroup = 'sousa';

    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static ?int $navigationSort = 3001;

    protected static string $view = 'sousa::filament.pages.overview';

    public function mount(): void
    {
        abort_unless(Auth::user()->can(DefaultPermissions::OVERVIEW_SOUSA), Response::HTTP_UNAUTHORIZED);

        $this->icons = Collection::times(361, function ($index) {
            $angle = $index - 1;

            return asset("/images/direction/output/dir-{$angle}.png");
        });

        $this->vessels = Vessel::all();

        $this->prepareVariables();
    }

    public function prepareVariables(): void
    {
        if (is_null($this->selectedVesselID)) {
            $this->selectedVessels = $this->vessels;
        } else {
            $this->selectedVessels = $this->vessels->filter(function (Vessel $vessel) {
                return $vessel->id == $this->selectedVesselID;
            });
        }

        $this->windows = $this->selectedVessels
            ->reject(function (Vessel $vessel) {
                return is_null($vessel->latestTrack);
            })
            ->map(function (Vessel $vessel) {
                return [
                    'name' => $vessel->name,
                    'latitude' => $vessel->latestTrack->latitude,
                    'longitude' => $vessel->latestTrack->longitude,
                    'speed' => $vessel->latestTrack->speed,
                    'cardinal_direction' => $vessel->latestTrack->cardinal_direction,
                    'cardinal_angle' => $vessel->latestTrack->cardinal_angle,
                    'status' => $vessel->latestTrack->status,
                    'last_update' => $vessel->latestTrack->tracking_finished_at->setTimezone('Asia/Jakarta')->toDatetimeString(),
                ];
            })
            ->values()
        ;

        $this->markers = $this->selectedVessels
            ->reject(function (Vessel $vessel) {
                return is_null($vessel->latestTrack);
            })
            ->map(function (Vessel $vessel) {
                return [
                    'name' => $vessel->name,
                    'latitude' => (float) $vessel->latestTrack->latitude,
                    'longitude' => (float) $vessel->latestTrack->longitude,
                    'angle' => (int) $vessel->latestTrack->cardinal_angle,
                ];
            })
            ->values()
        ;
    }

    public function onSelectedVesselsChanged(): void
    {
        $this->prepareVariables();

        $this->emit('selected_vessels_changed', [
            'windows' => $this->windows,
            'markers' => $this->markers,
        ]);
    }

    protected function getKey()
    {
        return config('services.google.maps.key');
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return Auth::user()->can(DefaultPermissions::OVERVIEW_SOUSA);
    }
}
