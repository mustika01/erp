<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\Filters;

use Filament\Forms;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class PeriodFilter extends Filter
{
    public static function make(?string $name = 'period'): static
    {
        return parent::make($name)
            ->form([
                Forms\Components\Select::make('year')
                    ->options(function () {
                        $options = Collection::make();

                        $start = Carbon::parse('2022-01-01');

                        while ($start->isBefore(Carbon::now())) {
                            $options->push($start->format('Y'));
                            $start->addYear();
                        }

                        return $options->mapWithKeys(function ($value) {
                            return [$value => $value];
                        });
                    })
                    ->default(Carbon::now()->format('Y')),
                Forms\Components\Select::make('month')
                    ->options(function () {
                        $options = Collection::make();

                        $start = Carbon::parse('2022-01-01');
                        $end = $start->copy()->endOfYear()->endOfMonth()->endOfDay();

                        while ($start->isBefore($end)) {
                            $options->push($start->format('F'));
                            $start->addMonth();
                        }

                        return $options->mapWithKeys(function ($value) {
                            return [$value => $value];
                        });
                    })
                    ->default(Carbon::now()->format('F')),
            ])
            ->query(function (Builder $query, array $data): Builder {
                $date = Carbon::parse($data['year'] . ' ' . $data['month']);
                $startDate = $date->startOfMonth()->startOfDay();
                $endDate = $date->endOfMonth()->endOfDay();

                return $query->dateBetween($startDate, $endDate);
            })
        ;
    }
}
