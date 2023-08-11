<?php

namespace Kumi\Kyoka\Providers;

use Kumi\Kyoka\Models\Role;
use Kumi\Tobira\Models\User;
use Kumi\Kyoka\Policies\RolePolicy;
use Kumi\Kyoka\Policies\UserPolicy;
use Illuminate\Support\Facades\Gate;
use Kumi\Kyoka\Support\DefaultRoles;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability) {
            if ($user->hasRole(DefaultRoles::SUPER_ADMINISTRATOR)) {
                return true;
            }
        });
    }
}
