<?php

namespace Kumi\Sousa\Providers;

use Illuminate\Support\ServiceProvider;
use Kumi\Sousa\Filament\Forms\DestinationChartsPeriod;
use Kumi\Sousa\Filament\Tables\ListJournalsTable;
use Kumi\Sousa\Filament\Tables\ListOilJournalsTable;
use Kumi\Sousa\Filament\Tables\ListVesselsToVoyagesTable;
use Kumi\Sousa\Filament\Tables\ListVoyagesTable;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    protected array $components = [
        'sousa::tables.list-vessels-to-voyages' => ListVesselsToVoyagesTable::class,
        'sousa::tables.list-voyages' => ListVoyagesTable::class,
        'sousa::tables.list-journals' => ListJournalsTable::class,
        'sousa::tables.list-oil-journals' => ListOilJournalsTable::class,
        'sousa::forms.destination-charts-period' => DestinationChartsPeriod::class,
    ];

    public function boot()
    {
        foreach ($this->components as $key => $value) {
            Livewire::component($key, $value);
        }
    }
}
