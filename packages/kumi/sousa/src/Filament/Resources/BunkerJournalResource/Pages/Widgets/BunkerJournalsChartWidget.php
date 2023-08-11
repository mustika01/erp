<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Pages\Widgets;

use Carbon\CarbonPeriod;
use Filament\Widgets\LineChartWidget;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Kumi\Sousa\Models\Bunker;
use Kumi\Sousa\Models\BunkerJournal;

class BunkerJournalsChartWidget extends LineChartWidget
{
    public ?Bunker $bunker = null;

    public int $year;
    public int $month;

    public Collection $period;
    public Collection $journals;

    protected static ?string $heading = 'Solar - Usage';

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

        $this->journals = $this->bunker
            ? $this->bunker
                ->journals()
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
                    'label' => 'Real Time',
                    'data' => $this->period->map(function (string $date) {
                        $journal = $this->journals->first(function (BunkerJournal $journal) use ($date) {
                            $date = Carbon::parse($date);

                            $hasSameDay = $journal->date->day === $date->day;
                            $hasSameMonth = $journal->date->month === $date->month;

                            return $hasSameDay && $hasSameMonth;
                        });

                        return $journal ? $journal->real_time_usage : 0;
                    }),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(59, 130, 246, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(59, 130, 246, 0.6)';
                    }),
                ],
                [
                    'label' => 'Expected',
                    'data' => $this->period->map(function (string $date) {
                        $journal = $this->journals->first(function (BunkerJournal $journal) use ($date) {
                            $date = Carbon::parse($date);

                            $hasSameDay = $journal->date->day === $date->day;
                            $hasSameMonth = $journal->date->month === $date->month;

                            return $hasSameDay && $hasSameMonth;
                        });

                        return $journal ? $journal->expected_usage : 0;
                    }),
                    'borderColor' => $this->period->map(function () {
                        return 'rgba(255, 95, 31, 1)';
                    }),
                    'backgroundColor' => $this->period->map(function () {
                        return 'rgba(255, 95, 31, 0.7)';
                    }),
                ],
            ],
            'labels' => $this->period,
        ];
    }
}
