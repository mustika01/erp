<?php

namespace Kumi\Kanri\Tests\Cases;

use Kumi\Kanri\KanriServiceProvider;
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
        parent::getEnvironmentSetUp($app);
    }

    protected function getPackageProviders($app)
    {
        return array_merge(
            parent::getPackageProviders($app),
            [
                KanriServiceProvider::class,
                JinzaiServiceProvider::class,
                KioskServiceProvider::class,
                CountriesEnServiceProvider::class,
            ]
        );
    }
}
