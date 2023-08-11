<?php

namespace Kumi\Norikumi\Tests\Cases;

use Kumi\Kiosk\KioskServiceProvider;
use Kumi\Jinzai\JinzaiServiceProvider;
use Squire\CountriesEnServiceProvider;
use Kumi\Kensa\TestCase as BaseTestCase;
use Kumi\Norikumi\NorikumiServiceProvider;

/**
 * @internal
 */
abstract class TestCase extends BaseTestCase
{
    public function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
    }

    protected function getPackageProviders($app)
    {
        return array_merge(
            parent::getPackageProviders($app),
            [
                NorikumiServiceProvider::class,
                JinzaiServiceProvider::class,
                KioskServiceProvider::class,
                CountriesEnServiceProvider::class,
            ]
        );
    }
}
