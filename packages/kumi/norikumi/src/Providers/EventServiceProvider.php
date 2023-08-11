<?php

namespace Kumi\Norikumi\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;
use Kumi\Norikumi\EventSubscribers\AssignmentEventSubscriber;
use Kumi\Norikumi\EventSubscribers\ContractEventSubscriber;
use Kumi\Norikumi\EventSubscribers\DepositEventSubscriber;
use Kumi\Norikumi\EventSubscribers\LoanEventSubscriber;
use Kumi\Norikumi\EventSubscribers\PayoutEventSubscriber;
use Kumi\Norikumi\EventSubscribers\PayrollEventSubscriber;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        PayrollEventSubscriber::class,
        PayoutEventSubscriber::class,
        LoanEventSubscriber::class,
        DepositEventSubscriber::class,
        ContractEventSubscriber::class,
        AssignmentEventSubscriber::class,
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
