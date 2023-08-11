<?php

namespace Kumi\Sousa;

use Kumi\Sousa\Providers\AuthServiceProvider;
use Kumi\Sousa\Providers\EventServiceProvider;
use Kumi\Sousa\Providers\AccessServiceProvider;
use Kumi\Sousa\Providers\PluginServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Kumi\Sousa\Providers\LivewireServiceProvider;

class SousaServiceProvider extends AggregateServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        PluginServiceProvider::class,
        AccessServiceProvider::class,
        AuthServiceProvider::class,
        // RelationServiceProvider::class,
        LivewireServiceProvider::class,
        EventServiceProvider::class,
    ];
}
