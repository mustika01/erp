<?php

namespace Kumi\AbstractJinzaiKiosk\Tests;

use Kumi\Kiosk\KioskServiceProvider;
use Kumi\Jinzai\JinzaiServiceProvider;
use Squire\CountriesEnServiceProvider;
use Kumi\Kensa\TestCase as BaseTestCase;

/**
 * @internal
 */
abstract class TestCase extends BaseTestCase
{
    public function getEnvironmentSetUp($app)
    {
        config()->set('services.inspector.url', 'http://localhost:5555/teamwork');

        parent::getEnvironmentSetUp($app);
    }

    protected function getPackageProviders($app)
    {
        return array_merge(
            parent::getPackageProviders($app),
            [
                JinzaiServiceProvider::class,
                KioskServiceProvider::class,
                CountriesEnServiceProvider::class,
            ]
        );
    }
}
