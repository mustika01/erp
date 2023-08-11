<?php

namespace Kumi\Kiosk\Tests;

use Illuminate\Support\Collection;
use Kumi\Kiosk\KioskServiceProvider;
use Kumi\AbstractJinzaiKiosk\Tests\TestCase;
use Kumi\Kiosk\Providers\AuthServiceProvider;
use Kumi\Kiosk\Providers\AccessServiceProvider;
use Kumi\Kiosk\Providers\PluginServiceProvider;
use Kumi\Kiosk\Providers\LivewireServiceProvider;

/**
 * @internal
 */
class KioskServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            KioskServiceProvider::class,
            PluginServiceProvider::class,
            AccessServiceProvider::class,
            LivewireServiceProvider::class,
            AuthServiceProvider::class,
        ])->each(function (string $provider) {
            $this->assertTrue($this->app->providerIsLoaded($provider));
        });
    }
}
