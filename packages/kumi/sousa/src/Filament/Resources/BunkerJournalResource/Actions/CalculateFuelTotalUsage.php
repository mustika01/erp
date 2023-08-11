<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateFuelTotalUsage
{
    use AsAction;

    public function handle(?\Closure $get = null, ?\Closure $set = null): ?\Closure
    {
        if (is_null($get) && is_null($set)) {
            return function (\Closure $get, \Closure $set) {
                $this->getImplementation($get, $set);
            };
        }

        $this->getImplementation($get, $set);

        return null;
    }

    protected function getImplementation(\Closure $get, \Closure $set): void
    {
        $totalUsage = Collection::make($get('../../entries.*.total_usage'))
            ->filter()
            ->map(function (string $consumption) {
                $consumption = Str::of($consumption)->replace(',', '')->toString();

                return (float) $consumption;
            })->sum();

        $set('../../total_usage', number_format($totalUsage, 3));
    }
}
