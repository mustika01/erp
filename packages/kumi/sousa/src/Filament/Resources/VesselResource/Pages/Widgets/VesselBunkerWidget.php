<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Pages\Widgets;

use Carbon\CarbonPeriod;
use Filament\Widgets\LineChartWidget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Models\BunkerJournal;

class VesselBunkerWidget extends LineChartWidget
{
    public const KEY_MONTH = 'month';
    public const KEY_QUARTER = 'quarter';
    public const KEY_YEAR = 'year';

    public ?string $filter = 'month';

    public ?Bunker $bunker = null;

    public Collection $period;
    public Collection $journals;

    protected static ?string $heading = 'Bunker';

    protected static ?string $maxHeight = '240px';

    protected int|string|array $columnSpan = 1;

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $this->initializeData($this->filter);

        return [
            'datasets' => [
                [
                    'label' => 'Usage',
                    'data' => match ($this->filter) {
                        self::KEY_MONTH => $this->compileMonthlyData(),
                        self::KEY_QUARTER => $this->compileQuarterlyData(),
                        self::KEY_YEAR => $this->compileYearlyData(),
                        default => null,
                    },
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(59, 130, 246, 1)';
                    }),
                ],
            ],
            'labels' => $this->period,
        ];
    }

    protected function getFilters(): ?array
    {
        return [
            self::KEY_MONTH => 'This month',
            self::KEY_QUARTER => 'Last 3 months',
            self::KEY_YEAR => 'This year',
        ];
    }

    protected function initializeData(string $filter): void
    {
        $start = match ($filter) {
            self::KEY_MONTH => Carbon::now()->startOfMonth()->startOfDay(),
            self::KEY_QUARTER => Carbon::now()->subQuarter()->startOfDay(),
            self::KEY_YEAR => Carbon::now()->startOfYear()->startOfMonth()->startOfDay(),
            default => Carbon::now(),
        };

        $end = match ($filter) {
            self::KEY_MONTH => Carbon::now()->endOfMonth()->endOfDay(),
            self::KEY_QUARTER => Carbon::now()->endOfDay(),
            self::KEY_YEAR => Carbon::now()->endOfYear()->endOfMonth()->endOfDay(),
            default => Carbon::now(),
        };

        match ($filter) {
            self::KEY_MONTH => $this->initializeMonthlyPeriod($start, $end),
            self::KEY_QUARTER => $this->initializeQuarterlyPeriod($start, $end),
            self::KEY_YEAR => $this->initializeYearlyPeriod($start, $end),
            default => null,
        };
    }

    protected function initializeMonthlyPeriod(Carbon $start, Carbon $end)
    {
        $this->period = Collection::make(CarbonPeriod::create($start, $end)->toArray())
            ->map(function (Carbon $instance) {
                return $instance->format('d M');
            })
        ;

        $this->journals = $this->bunker
            ? $this->bunker
                ->journals()
                ->getQuery()
                ->whereBetween('date', [$start, $end])
                ->get()
            : Collection::make()
        ;
    }

    protected function initializeQuarterlyPeriod(Carbon $start, Carbon $end)
    {
        $this->period = Collection::make(CarbonPeriod::create($start, $end)->toArray())
            ->filter(function (Carbon $instance) {
                return $instance->isSunday();
            })
            ->map(function (Carbon $instance) {
                return $instance->format('d M');
            })
            ->values()
        ;

        $this->period->pop();

        $this->journals = $this->bunker
            ? $this->bunker
                ->journals()
                ->getQuery()
                ->whereBetween('date', [$start, $end])
                ->get()
            : Collection::make()
        ;
    }

    protected function initializeYearlyPeriod(Carbon $start, Carbon $end)
    {
        $this->period = Collection::make(CarbonPeriod::create($start, $end)->toArray())
            ->filter(function (Carbon $instance) {
                return $instance->day === 1;
            })
            ->map(function (Carbon $instance) {
                return $instance->format('M y');
            })
            ->values()
        ;

        $this->journals = $this->bunker
            ? $this->bunker
                ->journals()
                ->getQuery()
                ->whereBetween('date', [$start, $end])
                ->get()
            : Collection::make()
        ;
    }

    protected function compileMonthlyData(): Collection
    {
        return $this->period->map(function (string $date) {
            $journal = $this->journals->first(function (BunkerJournal $journal) use ($date) {
                $date = Carbon::parse($date);

                $hasSameDay = $journal->date->day === $date->day;
                $hasSameMonth = $journal->date->month === $date->month;

                return $hasSameDay && $hasSameMonth;
            });

            return $journal ? $journal->real_time_usage : 0;
        });
    }

    protected function compileQuarterlyData(): Collection
    {
        return $this->period->map(function (string $date) {
            $journals = $this->journals->filter(function (BunkerJournal $journal) use ($date) {
                $date = Carbon::parse($date);

                return $journal->date->diffInDays($date) <= 7;
            });

            return $journals->sum('usage') ?? 0;
        });
    }

    protected function compileYearlyData(): Collection
    {
        return $this->period->map(function (string $date) {
            $journals = $this->journals->filter(function (BunkerJournal $journal) use ($date) {
                $start = Carbon::parse($date)->startOfMonth()->startOfDay();
                $end = Carbon::parse($date)->endOfMonth()->startOfDay();

                return $journal->date->between($start, $end);
            });

            return $journals->sum('usage') ?? 0;
        });
    }
}
