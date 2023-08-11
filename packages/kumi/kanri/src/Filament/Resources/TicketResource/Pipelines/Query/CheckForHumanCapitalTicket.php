<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pipelines\Query;

use Closure;
use Illuminate\Support\Facades\Auth;
use Kumi\Kiosk\Models\TicketCategory;
use Illuminate\Database\Eloquent\Builder;
use Kumi\Kanri\Support\DefaultPermissions;

class CheckForHumanCapitalTicket
{
    public function handle(Builder $builder, Closure $next)
    {
        $user = Auth::user();

        if ($user->can(DefaultPermissions::VIEW_HUMAN_CAPITAL_TICKETS)) {
            $salary = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY)->first();
            $advance = TicketCategory::query()->where('slug', TicketCategory::KEY_SALARY_ADVANCE)->first();

            $builder
                ->orWhere(function (Builder $query) use ($salary, $advance) {
                    $query->where('category_id', $salary->id)
                        ->where('child_category_id', $advance->id)
                    ;
                })
            ;
        }

        return $next($builder);
    }
}
