<?php

namespace Kumi\Senzou\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Kumi\Senzou\Models\DeliveryNote;
use Kumi\Senzou\Models\Item;
use Kumi\Senzou\Models\RequestNote;
use Kumi\Senzou\Models\RequestNoteItem;
use Kumi\Senzou\Models\VesselUser;
use Kumi\Senzou\Policies\DeliveryNotePolicy;
use Kumi\Senzou\Policies\ItemPolicy;
use Kumi\Senzou\Policies\RequestNoteItemPolicy;
use Kumi\Senzou\Policies\RequestNotePolicy;
use Kumi\Senzou\Policies\VesselUserPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        VesselUser::class => VesselUserPolicy::class,
        RequestNote::class => RequestNotePolicy::class,
        RequestNoteItem::class => RequestNoteItemPolicy::class,
        Item::class => ItemPolicy::class,
        DeliveryNote::class => DeliveryNotePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
