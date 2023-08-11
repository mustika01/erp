<?php

namespace Kumi\Jinzai;

use Kumi\Jinzai\Providers\AuthServiceProvider;
use Kumi\Jinzai\Providers\EventServiceProvider;
use Illuminate\Support\AggregateServiceProvider;
use Kumi\Jinzai\Providers\AccessServiceProvider;
use Kumi\Jinzai\Providers\PluginServiceProvider;
use Kumi\Jinzai\Providers\LivewireServiceProvider;
use Kumi\Jinzai\Providers\RelationServiceProvider;

class JinzaiServiceProvider extends AggregateServiceProvider
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
        RelationServiceProvider::class,
        LivewireServiceProvider::class,
        EventServiceProvider::class,
    ];

    /**
     * @codeCoverageIgnore
     */
    public static function getPackageProviders(): array
    {
        return [
            self::class,
        ];
    }
}
