<?php

namespace Kumi\Tobira\Events\Subscribers;

use Kumi\Tobira\Models\User;
use Illuminate\Auth\Events\Failed;
use Kumi\Kyoka\Support\SystemUser;
use Illuminate\Auth\Events\Verified;
use Illuminate\Auth\Events\PasswordReset;

class UserEventSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Events\Dispatcher $events
     *
     * @return array
     */
    public function subscribe($events)
    {
        return [
            Failed::class => 'onFailed',
            PasswordReset::class, 'onPasswordReset',
            Verified::class => 'onVerified',
        ];
    }

    public function onFailed(Failed $event): void
    {
        if (is_null($event->user)) {
            return;
        }

        activity()
            ->performedOn($event->user)
            ->causedBy(self::getSystemUser())
            ->log(__('tobira::models/user.events.failed'))
        ;
    }

    public function onPasswordReset(PasswordReset $event): void
    {
        activity()
            ->performedOn($event->user)
            ->causedBy(self::getSystemUser())
            ->log(__('tobira::models/user.events.password_reset'))
        ;
    }

    public function onVerified(Verified $event): void
    {
        activity()
            ->performedOn($event->user)
            ->causedBy(self::getSystemUser())
            ->log(__('tobira::models/user.events.verified'))
        ;
    }

    protected static function getSystemUser(): User
    {
        return User::where([
            ['name', '=', SystemUser::NAME],
            ['email', '=', SystemUser::EMAIL],
        ])->first();
    }
}
