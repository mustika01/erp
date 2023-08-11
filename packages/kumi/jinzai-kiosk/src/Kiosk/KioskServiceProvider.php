<?php

namespace Kumi\Kiosk;

use Kumi\Kiosk\Providers\AuthServiceProvider;
use Kumi\Kiosk\Providers\AccessServiceProvider;
use Kumi\Kiosk\Providers\PluginServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Kumi\Kiosk\Providers\LivewireServiceProvider;

class KioskServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        PluginServiceProvider::class,
        AccessServiceProvider::class,
        LivewireServiceProvider::class,
        AuthServiceProvider::class,
    ];
}
