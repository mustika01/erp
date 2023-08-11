<?php

namespace Kumi\Sousa\Filament\Widgets;

use Filament\Widgets\LineChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\VesselVoyage;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\FinishUnloading;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Kumi\Sousa\Models\VoyagePort;
use Kumi\Sousa\Models\VoyageStatus;

class DestinationVesselStatusesWidget extends LineChartWidget
{
    public int $destinationPortId;
    public string $started_at;
    public string $ended_at;
    public string $voyage_status;

    public Collection $voyages;
    public Collection $colors;

    protected static ?string $maxHeight = '240px';

    protected int|string|array $columnSpan = 1;

    protected function getHeading(): string
    {
        $port = VoyagePort::find($this->destinationPortId);

        return $port->name;
    }

    protected function getData(): array
    {
        $this->initializeColors();
        $this->initializeData();

        return [
            'datasets' => $this->voyages,
            'labels' => [
                'Loading',
                'O Parking',
                'Sailing',
                'D Parking',
                'Unloading',
            ],
        ];
    }

    protected function initializeData(): void
    {
        $this->voyages = VesselVoyage::query()
            ->whereState('status', FinishUnloading::class)
            ->where('destination_port_id', $this->destinationPortId)
            ->whereHas('statuses', function (Builder $query) {
                $query
                    ->where('description', $this->voyage_status)
                    ->whereBetween('executed_at', [$this->started_at, $this->ended_at])
                ;
            })
            ->get()
        ;

        $this->compileVoyagesData();
    }

    protected function compileVoyagesData(): void
    {
        if ($this->voyages->isEmpty()) {
            $this->voyages = Collection::make([
                [
                    'label' => 'N/A',
                    'data' => [0, 0, 0, 0, 0],
                    'borderColor' => [
                        'rgba(115, 115, 115, 1)',
                    ],
                    'backgroundColor' => [
                        'rgba(115, 115, 115, 1)',
                    ],
                ],
            ]);
        } else {
            $this->voyages = $this->voyages->map(function (VesselVoyage $voyage) {
                $data = [
                    $this->compileLoadingData($voyage),
                    $this->compileOriginParkingData($voyage),
                    $this->compileSailingData($voyage),
                    $this->compileDestinationParkingData($voyage),
                    $this->compileUnloadingData($voyage),
                ];

                $color = $this->generateColor();

                return [
                    'label' => "{$voyage->vessel->name} / No. {$voyage->number} / {$voyage->originPort->name} ",
                    'data' => $data,
                    'borderColor' => [
                        $color,
                    ],
                    'backgroundColor' => [
                        $color,
                    ],
                ];
            });
        }
    }

    protected function compileLoadingData(VesselVoyage $voyage): int
    {
        return $this->compileData($voyage, VoyageState::START_LOADING, VoyageState::FINISH_LOADING);
    }

    protected function compileSailingData(VesselVoyage $voyage): int
    {
        return $this->compileData($voyage, VoyageState::DEPARTED, VoyageState::ARRIVED);
    }

    protected function compileUnloadingData(VesselVoyage $voyage): int
    {
        return $this->compileData($voyage, VoyageState::START_UNLOADING, VoyageState::FINISH_UNLOADING);
    }

    protected function compileOriginParkingData(VesselVoyage $voyage): int
    {
        return $this->compileData($voyage, VoyageState::UNMOORED, VoyageState::DEPARTED);
    }

    protected function compileDestinationParkingData(VesselVoyage $voyage): int
    {
        return $this->compileData($voyage, VoyageState::ARRIVED, VoyageState::MOORED);
    }

    protected function compileData(VesselVoyage $voyage, string $startStatus, string $endStatus): int
    {
        $statuses = $voyage->statuses
            ->filter(function (VoyageStatus $status) use ($startStatus, $endStatus) {
                return in_array($status->description, [$startStatus, $endStatus]);
            })
            ->sortBy('executed_at')
            ->values()

        ;

        if ($statuses->isEmpty()) {
            return 0;
        }

        return $statuses
            ->map(function (VoyageStatus $status, int $index) use ($statuses, $startStatus, $endStatus) {
                if ($status->description === $startStatus) {
                    $beginningStatus = $statuses->get($index);
                    $endingStatus = $statuses->get($index + 1);

                    if (! $endingStatus) {
                        return 0;
                    }

                    if ($beginningStatus->description === $startStatus && $endingStatus->description === $endStatus) {
                        return $beginningStatus->executed_at->diffInHours($endingStatus->executed_at);
                    }
                }

                return 0;
            })
            ->sum()
        ;
    }

    protected function initializeColors(): void
    {
        $this->colors = Collection::make([
            'rgba(221, 255, 1, 1)',
            'rgba(0, 255, 255, 1)',
            'rgba(255, 0, 128, 0.8)',
            'rgba(235, 0, 255, 1)',
            'rgba(255, 130, 0, 1)',
            'rgba(0, 0, 255, 1)',
            'rgba(255, 255, 0, 1)',
            'rgba(0, 255, 0, 1)',
            'rgba(0, 173, 255, 1)',
            'rgba(255, 0, 0, 1)',
        ]);
    }

    protected function generateColor(): string
    {
        $color = $this->colors->pop();

        if ($this->colors->isEmpty()) {
            $this->colors = Collection::make([
                'rgba(221, 255, 1, 1)',
                'rgba(0, 255, 255, 1)',
                'rgba(255, 0, 128, 0.8)',
                'rgba(235, 0, 255, 1)',
                'rgba(255, 130, 0, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(255, 255, 0, 1)',
                'rgba(0, 255, 0, 1)',
                'rgba(0, 173, 255, 1)',
                'rgba(255, 0, 0, 1)',
            ]);
        }

        return $color;
    }
}
