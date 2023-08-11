<?php

namespace Kumi\Keiri\Providers;

use Kumi\Keiri\Support\DefaultRoles;
use Kumi\Keiri\Support\DefaultAccess;
use Kumi\Kyoka\Support\Facades\Access;
use Illuminate\Support\ServiceProvider;
use Kumi\Keiri\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
