<?php

namespace Kumi\Kyoka\Tests;

use Kumi\Kensa\TestCase;
use Illuminate\Support\Collection;
use Kumi\Kyoka\KyokaServiceProvider;
use Kumi\Kyoka\Providers\AuthServiceProvider;
use Kumi\Kyoka\Providers\EventServiceProvider;
use Kumi\Kyoka\Providers\AccessServiceProvider;
use Kumi\Kyoka\Providers\PluginServiceProvider;

/**
 * @internal
 */
class KyokaServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            KyokaServiceProvider::class,
            PluginServiceProvider::class,
            AccessServiceProvider::class,
            AuthServiceProvider::class,
            EventServiceProvider::class,
        ])->each(function (string $provider) {
            $this->assertTrue($this->app->providerIsLoaded($provider));
        });
    }
}
