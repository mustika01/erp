<?php

namespace Kumi\Keiri;

use Kumi\Keiri\Providers\AuthServiceProvider;
use Kumi\Keiri\Providers\EventServiceProvider;
use Kumi\Keiri\Providers\AccessServiceProvider;
use Kumi\Keiri\Providers\PluginServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class KeiriServiceProvider extends AggregateServiceProvider
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
        // LivewireServiceProvider::class,
        EventServiceProvider::class,
    ];
}
