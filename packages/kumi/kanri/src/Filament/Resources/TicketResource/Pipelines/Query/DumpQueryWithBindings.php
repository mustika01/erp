<?php

namespace Kumi\Kanri\Filament\Resources\TicketResource\Pipelines\Query;

use Closure;
use Illuminate\Database\Eloquent\Builder;

class DumpQueryWithBindings
{
    public function handle(Builder $builder, Closure $next)
    {
        dd($builder->toSqlWithBindings());
    }
}
