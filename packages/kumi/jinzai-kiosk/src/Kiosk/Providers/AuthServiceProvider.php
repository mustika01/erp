<?php

namespace Kumi\Kiosk\Providers;

use Kumi\Kiosk\Models\PersonalPayout;
use Kumi\Kiosk\Models\PersonalTicket;
use Kumi\Kiosk\Policies\PersonalPayoutPolicy;
use Kumi\Kiosk\Policies\PersonalTicketPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        PersonalTicket::class => PersonalTicketPolicy::class,
        PersonalPayout::class => PersonalPayoutPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
