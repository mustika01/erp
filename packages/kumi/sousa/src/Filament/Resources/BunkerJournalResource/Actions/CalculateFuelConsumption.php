<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Actions;

use Closure;
use Illuminate\Support\Carbon;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateFuelConsumption
{
    use AsAction;

    public function handle(?Closure $get = null, ?Closure $set = null): ?Closure
    {
        if (is_null($get) && is_null($set)) {
            return function (Closure $get, Closure $set) {
                $this->getImplementation($get, $set);
            };
        }

        $this->getImplementation($get, $set);

        return null;
    }

    protected function getImplementation(Closure $get, Closure $set): void
    {
        $consumption = $get('hourly_consumption');
        $start = $get('time_started_at');
        $finish = $get('time_finished_at');

        if (empty($start) || empty($finish) || empty($consumption)) {
            return;
        }

        $startCarbon = Carbon::parse($start);
        $finishCarbon = Carbon::parse($finish);
        $diffInMinutes = $startCarbon->diffInMinutes($finishCarbon);
        $totalConsumption = round($diffInMinutes / 60 * $consumption, 3);

        $set('total_minutes', $diffInMinutes);
        $set('total_usage', number_format($totalConsumption, 3));
    }
}
