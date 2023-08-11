<?php

namespace Kumi\Kanri\Providers;

use Kumi\Kanri\Support\DefaultRoles;
use Kumi\Kanri\Support\DefaultAccess;
use Kumi\Kyoka\Support\Facades\Access;
use Illuminate\Support\ServiceProvider;
use Kumi\Kanri\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
