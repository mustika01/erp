<?php

namespace Kumi\Yoyaku\Providers;

use Kumi\Yoyaku\Models\Booking;
use Kumi\Yoyaku\Models\Bookable;
use Kumi\Yoyaku\Policies\BookingPolicy;
use Kumi\Yoyaku\Policies\BookablePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Bookable::class => BookablePolicy::class,
        Booking::class => BookingPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
