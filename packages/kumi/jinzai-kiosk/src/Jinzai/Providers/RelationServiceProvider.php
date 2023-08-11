<?php

namespace Kumi\Jinzai\Providers;

use Kumi\Tobira\Models\User;
use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Models\Employee;
use Illuminate\Support\ServiceProvider;

class RelationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        User::resolveRelationUsing('employee', function ($model) {
            return $model->hasOne(Employee::class);
        });

        User::resolveRelationUsing('payroll', function ($model) {
            return $model->hasOneThrough(Payroll::class, Employee::class);
        });
    }
}
