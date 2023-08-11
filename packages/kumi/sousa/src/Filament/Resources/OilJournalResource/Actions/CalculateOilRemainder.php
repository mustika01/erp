<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Kumi\Sousa\Support\Enums\OilJournalEntryType;
use Kumi\Sousa\Support\Enums\OilJournalOilType;
use Lorisleiva\Actions\Concerns\AsAction;

class CalculateOilRemainder
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
        Collection::make([
            OilJournalOilType::TYPE_10,
            OilJournalOilType::TYPE_40,
            OilJournalOilType::TYPE_90,
        ])->each(function (string $oilType) use ($get, $set) {
            $robAmount = $get('../../rob_amount_type_90');

            if (is_null($robAmount) || $robAmount === '') {
                return;
            }

            $totalReFuel = Collection::make($get('../../entries'))
                ->filter(function (array $attributes) {
                    return $attributes['entry_type'] == OilJournalEntryType::REFUEL;
                })
                ->filter(function (array $attributes) use ($oilType) {
                    return $attributes['oil_type'] == $oilType;
                })
                ->map(function (array $attributes) {
                    $amount = Str::of($attributes['total_litre'])->replace(',', '')->toString();

                    return (float) $amount;
                })
                ->sum()
            ;

            $totalUsage = Collection::make($get('../../entries'))
                ->filter(function (array $attributes) {
                    return $attributes['entry_type'] == OilJournalEntryType::USAGE;
                })
                ->filter(function (array $attributes) use ($oilType) {
                    return $attributes['oil_type'] == $oilType;
                })
                ->map(function (array $attributes) {
                    $amount = Str::of($attributes['total_litre'])->replace(',', '')->toString();

                    return (float) $amount;
                })
                ->sum()
            ;

            $remainder = round((float) $robAmount + $totalReFuel - $totalUsage, 3);

            $fieldName = "../../remainder_{$oilType}";

            $set($fieldName, number_format($remainder, 3));
        });
    }
}
