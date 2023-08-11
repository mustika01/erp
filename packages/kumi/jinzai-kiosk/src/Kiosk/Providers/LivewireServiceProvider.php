<?php

namespace Kumi\Kiosk\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Kumi\Kiosk\Http\Livewire\Forms\EmployeeInformationForm;

class LivewireServiceProvider extends ServiceProvider
{
    protected array $components = [
        'kiosk::forms.employee-information' => EmployeeInformationForm::class,
    ];

    public function boot()
    {
        foreach ($this->components as $key => $value) {
            Livewire::component($key, $value);
        }
    }
}
