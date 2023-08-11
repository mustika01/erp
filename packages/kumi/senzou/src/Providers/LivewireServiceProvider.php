<?php

namespace Kumi\Senzou\Providers;

use Illuminate\Support\ServiceProvider;
use Kumi\Senzou\Filament\Forms\DeliveryNoteDailyReportForm;
use Kumi\Senzou\Filament\Tables\DeliveryNoteEntriesDailyReportTable;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    protected array $components = [
        'senzou::forms.delivery-note-daily-report' => DeliveryNoteDailyReportForm::class,
        'senzou::tables.delivery-note-daily-report-entries' => DeliveryNoteEntriesDailyReportTable::class,
    ];

    public function boot()
    {
        foreach ($this->components as $key => $value) {
            Livewire::component($key, $value);
        }
    }
}
