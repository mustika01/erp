<?php

namespace Kumi\Norikumi\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Kumi\Norikumi\Filament\Tables\ListVessels;
use Kumi\Norikumi\Filament\Tables\ListAssignments;
use Kumi\Norikumi\Http\Livewire\Forms\PINCodeForm;
use Kumi\Norikumi\Http\Livewire\Forms\RegistrationForm;

class LivewireServiceProvider extends ServiceProvider
{
    protected array $components = [
        'norikumi::forms.pin-code' => PINCodeForm::class,
        'norikumi::forms.registration' => RegistrationForm::class,
        'norikumi::tables.list-vessels' => ListVessels::class,
        'norikumi::tables.list-assignments' => ListAssignments::class,
    ];

    public function boot()
    {
        foreach ($this->components as $key => $value) {
            Livewire::component($key, $value);
        }
    }
}
