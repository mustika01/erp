<?php

namespace Kumi\Norikumi\Tests;

use Illuminate\Support\Collection;
use Kumi\Norikumi\Tests\Cases\TestCase;
use Kumi\Norikumi\NorikumiServiceProvider;
use Kumi\Norikumi\Providers\AuthServiceProvider;
use Kumi\Norikumi\Providers\AccessServiceProvider;
use Kumi\Norikumi\Providers\PluginServiceProvider;

/**
 * @internal
 */
class NorikumiServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            NorikumiServiceProvider::class,
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
