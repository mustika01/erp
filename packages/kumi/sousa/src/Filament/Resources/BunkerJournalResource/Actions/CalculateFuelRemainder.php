<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Actions;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateFuelRemainder
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
        $robAmount = $get('../../rob_amount');

        if (is_null($robAmount) || $robAmount === '') {
            return;
        }

        $totalReFuel = Collection::make($get('../../entries.*.total_refuel'))
            ->filter()
            ->map(function (string $amount) {
                $amount = Str::of($amount)->replace(',', '')->toString();

                return (float) $amount;
            })->sum();

        $totalUsage = Collection::make($get('../../entries.*.total_usage'))
            ->filter()
            ->map(function (string $consumption) {
                $consumption = Str::of($consumption)->replace(',', '')->toString();

                return (float) $consumption;
            })->sum();

        $totalAdjustment = Collection::make($get('../../entries.*.total_adjustment'))
            ->filter()
            ->map(function (string $adjustment) {
                $adjustment = Str::of($adjustment)->replace(',', '')->toString();

                return (float) $adjustment;
            })->sum();

        $remainder = round((float) $robAmount + $totalReFuel - $totalUsage - $totalAdjustment, 3);

        $set('../../remainder', number_format($remainder, 3));
    }
}
