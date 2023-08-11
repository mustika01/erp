<?php

namespace Kumi\Jinzai\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use Kumi\Jinzai\Http\Livewire\Forms\OnboardingForm;

class LivewireServiceProvider extends ServiceProvider
{
    protected array $components = [
        'jinzai::forms.onboarding' => OnboardingForm::class,
    ];

    public function boot()
    {
        foreach ($this->components as $key => $value) {
            Livewire::component($key, $value);
        }
    }
}
