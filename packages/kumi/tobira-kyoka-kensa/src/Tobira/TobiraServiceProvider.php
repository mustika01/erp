<?php

namespace Kumi\Tobira;

use Kumi\Tobira\Providers\EventServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Kumi\Tobira\Providers\AccessServiceProvider;
use Kumi\Tobira\Providers\PluginServiceProvider;
use Kumi\Tobira\Providers\FortifyServiceProvider;
use Kumi\Tobira\Providers\FilamentServiceProvider;
use Kumi\Tobira\Providers\LivewireServiceProvider;

class TobiraServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        PluginServiceProvider::class,
        AccessServiceProvider::class,
        FortifyServiceProvider::class,
        FilamentServiceProvider::class,
        LivewireServiceProvider::class,
        EventServiceProvider::class,
    ];
}
