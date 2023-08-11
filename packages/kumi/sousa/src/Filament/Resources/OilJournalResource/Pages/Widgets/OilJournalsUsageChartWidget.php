<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Pages\Widgets;

use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Kumi\Sousa\Models\Bunker;
use Illuminate\Support\Carbon;
use Kumi\Sousa\Models\OilJournal;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Filament\Widgets\LineChartWidget;

class OilJournalsUsageChartWidget extends LineChartWidget
{
    public ?Bunker $bunker = null;

    public int $year;
    public int $month;

    public Collection $period;
    public Collection $oils;

    protected static ?string $heading = 'Oil - Usage';

    protected static ?string $maxHeight = '240px';

    protected int|string|array $columnSpan = 'full';

    protected static ?string $pollingInterval = '3s';

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => true,
            ],
        ],
    ];

    protected $listeners = [
        'filterPeriod' => 'updateStats',
    ];

    public function mount()
    {
        $request = App::make(Request::class);

        if ($request->has('tableFilters')) {
            $data = $request->get('tableFilters')['period'];

            $this->updateStats([
                'year' => $data['year'],
                'month' => $data['month'],
            ]);
        } else {
            $this->updateStats([
                'year' => Carbon::now()->year,
                'month' => Carbon::now()->month,
            ]);
        }

        parent::mount();
    }

    public function updateStats(array $data): void
    {
        $this->year = (int) $data['year'];
        $this->month = (int) $data['month'];

        $this->period = Collection::make(
            CarbonPeriod::create(
                Carbon::create()->month($this->month)->year($this->year)->startOfMonth(),
                Carbon::create()->month($this->month)->year($this->year)->endOfMonth(),
            )->toArray()
        )->map(function (Carbon $instance) {
            return $instance->format('d M');
        });

        $this->oils = $this->bunker
            ? $this->bunker
                ->oils()
                ->getQuery()
                ->whereMonth('date', $this->month)
                ->whereYear('date', $this->year)
                ->get()
            : Collection::make()
        ;
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Usage T.90',
                    'data' => $this->period->map(function (string $date) {
                        $journal = $this->oils->first(function (OilJournal $journal) use ($date) {
                            $date = Carbon::parse($date);

                            $hasSameDay = $journal->date->day === $date->day;
                            $hasSameMonth = $journal->date->month === $date->month;

                            return $hasSameDay && $hasSameMonth;
                        });

                        return $journal ? $journal->total_usage_type_90 : 0;
                    }),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(255, 255, 0, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(255, 255, 0, 0.6)';
                    }),
                ],

                [
                    'label' => 'Usage T.40',
                    'data' => $this->period->map(function (string $date) {
                        $journal = $this->oils->first(function (OilJournal $journal) use ($date) {
                            $date = Carbon::parse($date);

                            $hasSameDay = $journal->date->day === $date->day;
                            $hasSameMonth = $journal->date->month === $date->month;

                            return $hasSameDay && $hasSameMonth;
                        });

                        return $journal ? $journal->total_usage_type_40 : 0;
                    }),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(38, 194, 129, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(38, 194, 129, 0.6)';
                    }),
                ],

                [
                    'label' => 'Usage T.10',
                    'data' => $this->period->map(function (string $date) {
                        $journal = $this->oils->first(function (OilJournal $journal) use ($date) {
                            $date = Carbon::parse($date);

                            $hasSameDay = $journal->date->day === $date->day;
                            $hasSameMonth = $journal->date->month === $date->month;

                            return $hasSameDay && $hasSameMonth;
                        });

                        return $journal ? $journal->total_usage_type_10 : 0;
                    }),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(255, 69, 0, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(255, 69, 0, 0.6)';
                    }),
                ],

            ],
            'labels' => $this->period,
        ];
    }
}
