<?php

namespace Kumi\Kanshi\Providers;

use Kumi\Kanshi\Models\Activity;
use Illuminate\Support\ServiceProvider;

class ActivityLogServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        config(['activitylog.activity_model' => Activity::class]);
    }
}
