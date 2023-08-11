<?php

namespace Kumi\Zaimu;

use Kumi\Zaimu\Providers\AuthServiceProvider;
use Kumi\Zaimu\Providers\EventServiceProvider;
use Kumi\Zaimu\Providers\AccessServiceProvider;
use Kumi\Zaimu\Providers\PluginServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class ZaimuServiceProvider extends AggregateServiceProvider
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
