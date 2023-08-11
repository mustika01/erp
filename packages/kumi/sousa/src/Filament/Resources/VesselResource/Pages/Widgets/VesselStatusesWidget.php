<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets;

use Carbon\CarbonPeriod;
use Filament\Widgets\LineChartWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\Vessel;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\FinishUnloading;
use Kumi\Sousa\Models\VesselVoyage\States\VoyageState\VoyageState;
use Kumi\Sousa\Models\VoyageStatus;

class VesselStatusesWidget extends LineChartWidget
{
    public const KEY_QUARTER = 'quarter';
    public const KEY_YEAR = 'year';

    public ?string $filter = 'quarter';

    public ?Vessel $vessel = null;

    public Collection $period;
    public Collection $statuses;

    protected static ?string $heading = 'Statuses';

    protected static ?string $maxHeight = '240px';

    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
        $this->initializeData($this->filter);

        return [
            'datasets' => [
                [
                    'label' => 'Loading',
                    'data' => $this->compileLoadingData(),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(239, 68, 68, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(239, 68, 68, 0.5)';
                    }),
                ],
                [
                    'label' => 'O Parking',
                    'data' => $this->compileOriginParkingData(),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(99, 102, 241, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(99, 102, 241, 0.5)';
                    }),
                ],
                [
                    'label' => 'Sailing',
                    'data' => $this->compileSailingData(),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(59, 130, 246, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(59, 130, 246, 0.5)';
                    }),
                ],
                [
                    'label' => 'D Parking',
                    'data' => $this->compileDestinationParkingData(),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(249, 115, 22, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(249, 115, 22, 0.5)';
                    }),
                ],
                [
                    'label' => 'Unloading',
                    'data' => $this->compileUnloadingData(),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(34, 197, 94, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(34, 197, 94, 0.5)';
                    }),
                ],
            ],
            'labels' => $this->period,
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            self::KEY_QUARTER => 'Last 3 months',
            self::KEY_YEAR => 'This year',
        ];
    }

    protected function initializeData(string $filter): void
    {
        $start = match ($filter) {
            self::KEY_QUARTER => Carbon::now()->subQuarter()->startOfDay(),
            self::KEY_YEAR => Carbon::now()->startOfYear()->startOfMonth()->startOfDay(),
            default => Carbon::now(),
        };

        $end = match ($filter) {
            self::KEY_QUARTER => Carbon::now()->endOfDay(),
            self::KEY_YEAR => Carbon::now()->endOfYear()->endOfMonth()->endOfDay(),
            default => Carbon::now(),
        };

        $this->initializePeriod($start, $end);
    }

    protected function initializePeriod(Carbon $start, Carbon $end)
    {
        $this->period = Collection::make(CarbonPeriod::create($start, $end)->toArray())
            ->filter(function (Carbon $instance) {
                return $instance->day === 1;
            })
            ->map(function (Carbon $instance) {
                return $instance->format('M Y');
            })
            ->values()
        ;

        $voyages = $this->vessel
            ->voyages()
            ->getQuery()
            ->whereState('status', FinishUnloading::class)
            ->whereHas('statuses', function (Builder $query) use ($start, $end) {
                $query->whereBetween('executed_at', [$start, $end]);
            })
            ->get()
        ;

        $this->statuses = $voyages->map->statuses->flatten(1);
    }

    protected function compileLoadingData(): Collection
    {
        return $this->compileData(VoyageState::START_LOADING, VoyageState::FINISH_LOADING);
    }

    protected function compileSailingData(): Collection
    {
        return $this->compileData(VoyageState::DEPARTED, VoyageState::ARRIVED);
    }

    protected function compileUnloadingData(): Collection
    {
        return $this->compileData(VoyageState::START_UNLOADING, VoyageState::FINISH_UNLOADING);
    }

    protected function compileOriginParkingData(): Collection
    {
        return $this->compileData(VoyageState::UNMOORED, VoyageState::DEPARTED);
    }

    protected function compileDestinationParkingData(): Collection
    {
        return $this->compileData(VoyageState::ARRIVED, VoyageState::MOORED);
    }

    protected function compileData(string $startStatus, string $endStatus): Collection
    {
        return $this->period->map(function (string $date) use ($startStatus, $endStatus) {
            $statuses = $this->statuses
                ->filter(function (VoyageStatus $status) use ($date, $startStatus, $endStatus) {
                    $start = Carbon::parse($date)->startOfMonth()->startOfDay();
                    $end = Carbon::parse($date)->endOfMonth()->startOfDay();

                    return $status->executed_at->between($start, $end)
                        && in_array($status->description, [$startStatus, $endStatus]);
                })
                ->sortBy('executed_at')
                ->values()
            ;

            if ($statuses->isEmpty()) {
                return 0;
            }

            return $statuses
                ->map(function (VoyageStatus $status, int $index) use ($statuses, $startStatus) {
                    if ($status->description === $startStatus) {
                        $beginningStatus = $status;
                        $endingStatus = $statuses->get($index + 1);

                        if (! $endingStatus) {
                            return 0;
                        }

                        if ($beginningStatus->description === $startStatus && $endingStatus->description === $endingStatus) {
                            return $beginningStatus->executed_at->diffInHours($endingStatus->executed_at);
                        }
                    }

                    return 0;
                })
                ->sum()
            ;
        });
    }
}
