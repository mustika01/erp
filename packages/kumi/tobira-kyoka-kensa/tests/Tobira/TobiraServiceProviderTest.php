<?php

namespace Kumi\Tobira\Tests;

use Kumi\Kensa\TestCase;
use Illuminate\Support\Collection;
use Kumi\Tobira\TobiraServiceProvider;
use Kumi\Tobira\Providers\AccessServiceProvider;
use Kumi\Tobira\Providers\PluginServiceProvider;
use Kumi\Tobira\Providers\FilamentServiceProvider;
use Kumi\Tobira\Providers\LivewireServiceProvider;

/**
 * @internal
 */
class TobiraServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            TobiraServiceProvider::class,
            PluginServiceProvider::class,
            AccessServiceProvider::class,
            FilamentServiceProvider::class,
            LivewireServiceProvider::class,
        ])->each(function (string $provider) {
            $this->assertTrue($this->app->providerIsLoaded($provider));
        });
    }
}
