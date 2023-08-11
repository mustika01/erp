<?php

namespace Kumi\Keiri\Tests;

use Illuminate\Support\Collection;
use Kumi\Keiri\KeiriServiceProvider;
use Kumi\Keiri\Tests\Cases\TestCase;
use Kumi\Keiri\Providers\AuthServiceProvider;
use Kumi\Keiri\Providers\AccessServiceProvider;
use Kumi\Keiri\Providers\PluginServiceProvider;

/**
 * @internal
 */
class KeiriServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            KeiriServiceProvider::class,
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
