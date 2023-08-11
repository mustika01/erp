<?php

namespace Kumi\Jinzai\Tests;

use Illuminate\Support\Collection;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Jinzai\JinzaiServiceProvider;
use Kumi\Jinzai\Providers\AuthServiceProvider;
use Kumi\Jinzai\Providers\EventServiceProvider;
use Kumi\Jinzai\Providers\AccessServiceProvider;
use Kumi\Jinzai\Providers\PluginServiceProvider;
use Kumi\Jinzai\Providers\LivewireServiceProvider;
use Kumi\Jinzai\Providers\RelationServiceProvider;

/**
 * @internal
 */
class JinzaiServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            JinzaiServiceProvider::class,
            PluginServiceProvider::class,
            AccessServiceProvider::class,
            AuthServiceProvider::class,
            RelationServiceProvider::class,
            LivewireServiceProvider::class,
            EventServiceProvider::class,
        ])->each(function (string $provider) {
            $this->assertTrue($this->app->providerIsLoaded($provider));
        });
    }
}
