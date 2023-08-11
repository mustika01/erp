<?php

namespace Kumi\Kanri\Tests;

use Illuminate\Support\Collection;
use Kumi\Kanri\KanriServiceProvider;
use Kumi\Kanri\Tests\Cases\TestCase;
use Kumi\Kanri\Providers\AuthServiceProvider;
use Kumi\Kanri\Providers\AccessServiceProvider;
use Kumi\Kanri\Providers\PluginServiceProvider;

/**
 * @internal
 */
class KanriServiceProviderTest extends TestCase
{
    /** @test */
    public function it_can_load_the_service_providers(): void
    {
        Collection::make([
            KanriServiceProvider::class,
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
