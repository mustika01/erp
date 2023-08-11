<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Pages\Widgets;

use Carbon\CarbonPeriod;
use Filament\Widgets\LineChartWidget;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Kumi\Sousa\Models\BunkerJournal;

class SingleVoyageBunkerJournalsWidget extends LineChartWidget
{
    public ?Model $record = null;

    protected static ?string $heading = 'Bunker';

    protected static ?string $maxHeight = '330px';

    protected int|string|array $columnSpan = 2;

    protected static ?array $options = [
        'plugins' => [
            'legend' => [
                'display' => false,
            ],
        ],
    ];

    protected function getData(): array
    {
        $bunker = $this->record->vessel->bunker;
        $hasStatuses = $this->record->statuses()->count() > 0;

        if (! $bunker || ! $hasStatuses) {
            return [];
        }

        $start = $this->record->statuses()->oldest()->first()->executed_at;
        $finish = $this->record->statuses()->latest()->first()->executed_at;

        $period = Collection::make(
            CarbonPeriod::create(
                $start,
                $finish,
            )->toArray()
        )->map(function (Carbon $instance) {
            return $instance->format('d M');
        });

        $journals = $bunker
            ->journals()
            ->getQuery()
            ->whereBetween('date', [$start, $finish])
            ->get()
        ;

        return [
            'datasets' => [
                [
                    'label' => 'Usage',
                    'data' => $period->map(function (string $date) use ($journals) {
                        $journal = $journals->first(function (BunkerJournal $journal) use ($date) {
                            $date = Carbon::parse($date);

                            $hasSameDay = $journal->date->day === $date->day;
                            $hasSameMonth = $journal->date->month === $date->month;

                            return $hasSameDay && $hasSameMonth;
                        });

                        return $journal ? $journal->real_time_usage : 0;
                    }),
                    'backgroundColor' => $period->map(function () {
                        return 'rgba(59, 130, 246, 1)';
                    }),
                ],
            ],
            'labels' => $period,
        ];
    }
}
