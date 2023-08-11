<?php

namespace Kumi\Jinzai\Providers;

use Kumi\Tobira\Events\User\PasswordUpdated;
use Kumi\Jinzai\EventSubscribers\LoanEventSubscriber;
use Kumi\Jinzai\EventSubscribers\PayoutEventSubscriber;
use Kumi\Jinzai\EventSubscribers\PayrollEventSubscriber;
use Kumi\Jinzai\EventSubscribers\EmployeeEventSubscriber;
use Kumi\Jinzai\EventSubscribers\EmploymentEventSubscriber;
use Kumi\Jinzai\EventListeners\DispatchUpdateMailboxPasswordJob;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as BaseEventServiceProvider;

class EventServiceProvider extends BaseEventServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        PasswordUpdated::class => [
            DispatchUpdateMailboxPasswordJob::class,
        ],
    ];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [
        EmployeeEventSubscriber::class,
        EmploymentEventSubscriber::class,
        PayrollEventSubscriber::class,
        PayoutEventSubscriber::class,
        LoanEventSubscriber::class,
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
