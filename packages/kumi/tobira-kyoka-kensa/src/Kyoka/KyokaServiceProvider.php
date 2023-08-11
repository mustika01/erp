<?php

namespace Kumi\Kyoka;

use Kumi\Kyoka\Providers\AuthServiceProvider;
use Kumi\Kyoka\Providers\EventServiceProvider;
use Kumi\Kyoka\Providers\AccessServiceProvider;
use Kumi\Kyoka\Providers\PluginServiceProvider;
use Illuminate\Support\AggregateServiceProvider;

class KyokaServiceProvider extends AggregateServiceProvider
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
        EventServiceProvider::class,
    ];
}
