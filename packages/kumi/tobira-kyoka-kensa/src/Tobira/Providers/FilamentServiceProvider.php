<?php

namespace Kumi\Tobira\Providers;

use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        config(['filament.auth.pages.login' => null]);
    }
}
