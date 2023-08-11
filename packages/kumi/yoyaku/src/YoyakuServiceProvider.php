<?php

namespace Kumi\Yoyaku;

use Kumi\Yoyaku\Providers\AuthServiceProvider;
use Kumi\Yoyaku\Providers\EventServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Kumi\Yoyaku\Providers\AccessServiceProvider;
use Kumi\Yoyaku\Providers\PluginServiceProvider;

class YoyakuServiceProvider extends AggregateServiceProvider
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
