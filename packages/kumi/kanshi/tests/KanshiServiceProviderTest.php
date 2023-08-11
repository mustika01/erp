<?php

namespace Kumi\Kanshi\Tests;

use Illuminate\Support\Collection;
use Kumi\Kanshi\Tests\Cases\TestCase;
use Kumi\Kanshi\KanshiServiceProvider;
use Kumi\Kanshi\Providers\AuthServiceProvider;
use Kumi\Kanshi\Providers\AccessServiceProvider;
use Kumi\Kanshi\Providers\PluginServiceProvider;
use Kumi\Kanshi\Providers\ActivityLogServiceProvider;

/**
 * @internal
 */
class KanshiServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            KanshiServiceProvider::class,
            PluginServiceProvider::class,
            AccessServiceProvider::class,
            AuthServiceProvider::class,
            ActivityLogServiceProvider::class,
        ])->each(function (string $provider) {
            $this->assertTrue($this->app->providerIsLoaded($provider));
        });
    }
}
