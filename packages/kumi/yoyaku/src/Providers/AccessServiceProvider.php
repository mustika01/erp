<?php

namespace Kumi\Yoyaku\Providers;

use Kumi\Yoyaku\Support\DefaultRoles;
use Kumi\Kyoka\Support\Facades\Access;
use Kumi\Yoyaku\Support\DefaultAccess;
use Illuminate\Support\ServiceProvider;
use Kumi\Yoyaku\Support\DefaultPermissions;

class AccessServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Access::registerRoles(DefaultRoles::getRoles());
        Access::registerPermissions(DefaultPermissions::getPermissions());
        Access::registerAccess(DefaultAccess::getAccess());
    }
}
