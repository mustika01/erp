<?php

namespace Kumi\Senzou\Tests;

use Illuminate\Support\Collection;
use Kumi\Senzou\Providers\AccessServiceProvider;
use Kumi\Senzou\Providers\AuthServiceProvider;
use Kumi\Senzou\Providers\PluginServiceProvider;
use Kumi\Senzou\SenzouServiceProvider;
use Kumi\Senzou\Tests\Cases\TestCase;

/**
 * @internal
 */
class SenzouServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            SenzouServiceProvider::class,
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
