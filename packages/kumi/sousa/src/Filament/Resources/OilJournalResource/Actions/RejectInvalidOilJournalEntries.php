<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Actions;

use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;

class RejectInvalidOilJournalEntries
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
        $entries = Collection::make($get('../../entries'))
            ->reject(function (array $attributes) {
                return ! isset($attributes['entry_type'])
                    || ! isset($attributes['oil_type'])
                    || ! isset($attributes['total_litre']);
            })
        ;

        $set('../../entries', $entries->toArray());
    }
}
