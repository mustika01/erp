<?php

namespace Kumi\Kanri;

use Kumi\Kanri\Providers\AuthServiceProvider;
use Kumi\Kanri\Providers\EventServiceProvider;
use Kumi\Kanri\Providers\AccessServiceProvider;
use Kumi\Kanri\Providers\PluginServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class KanriServiceProvider extends AggregateServiceProvider
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
