<?php

namespace Kumi\Senzou;

use Illuminate\Support\AggregateServiceProvider;
use Kumi\Senzou\Providers\AccessServiceProvider;
use Kumi\Senzou\Providers\AuthServiceProvider;
use Kumi\Senzou\Providers\EventServiceProvider;
use Kumi\Senzou\Providers\LivewireServiceProvider;
use Kumi\Senzou\Providers\PluginServiceProvider;

class SenzouServiceProvider extends AggregateServiceProvider
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
