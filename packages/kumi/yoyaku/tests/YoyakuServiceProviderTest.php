<?php

namespace Kumi\Yoyaku\Tests;

use Illuminate\Support\Collection;
use Kumi\Yoyaku\Tests\Cases\TestCase;
use Kumi\Yoyaku\Providers\AuthServiceProvider;
use Kumi\Yoyaku\Providers\AccessServiceProvider;
use Kumi\Yoyaku\Providers\PluginServiceProvider;

/**
 * @internal
 */
class YoyakuServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            YoyakuServiceProvider::class,
            PluginServiceProvider::class,
            AccessServiceProvider::class,
            AuthServiceProvider::class,
            // RelationServiceProvider::class,
            // LivewireServiceProvider::class,
            // EventServiceProvider::class,
        ])->each(function (string $provider) {
            $this->assertTrue($this->app->providerIsLoaded($provider));
        });
    }
}
