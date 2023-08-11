<?php

namespace Kumi\Norikumi;

use Illuminate\Support\AggregateServiceProvider;
use Kumi\Norikumi\Providers\AccessServiceProvider;
use Kumi\Norikumi\Providers\AuthServiceProvider;
use Kumi\Norikumi\Providers\EventServiceProvider;
use Kumi\Norikumi\Providers\LivewireServiceProvider;
use Kumi\Norikumi\Providers\PluginServiceProvider;

class NorikumiServiceProvider extends AggregateServiceProvider
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
        LivewireServiceProvider::class,
        EventServiceProvider::class,
    ];
}
