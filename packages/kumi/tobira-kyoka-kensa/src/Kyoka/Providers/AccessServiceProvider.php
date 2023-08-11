<?php

namespace Kumi\Kyoka\Providers;

use Kumi\Kyoka\Auth\AccessManager;
use Kumi\Kyoka\Support\DefaultRoles;
use Kumi\Kyoka\Support\DefaultAccess;
use Kumi\Kyoka\Support\Facades\Access;
use Illuminate\Support\ServiceProvider;
use Kumi\Kyoka\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AccessManager::class);
    }

    public function boot(): void
    {
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
