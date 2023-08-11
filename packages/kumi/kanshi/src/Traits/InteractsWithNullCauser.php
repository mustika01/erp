<?php

namespace Kumi\Kanshi\Traits;

use Kumi\Tobira\Models\User;
use Kumi\Kanshi\Models\Activity;
use Kumi\Kyoka\Support\SystemUser;

trait InteractsWithNullCauser
{
    public function handleNullCauser(Activity $activity)
    {
        if (is_null($activity->causer)) {
            $system = User::query()->where([
                ['name', '=', SystemUser::NAME],
                ['email', '=', SystemUser::EMAIL],
            ])->first();

            $activity->causer_type = User::class;
            $activity->causer_id = $system->id;
        }

        return $activity;
    }
}
