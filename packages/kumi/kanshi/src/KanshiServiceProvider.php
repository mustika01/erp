<?php

namespace Kumi\Kanshi;

use Kumi\Kanshi\Providers\AuthServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Kumi\Kanshi\Providers\AccessServiceProvider;
use Kumi\Kanshi\Providers\PluginServiceProvider;
use Kumi\Kanshi\Providers\ActivityLogServiceProvider;

class KanshiServiceProvider extends AggregateServiceProvider
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
        ActivityLogServiceProvider::class,
    ];
}
