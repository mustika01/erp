<?php

namespace Kumi\Kyoka\Actions\User;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckForLoggedInRecord
{
    use AsAction;

    public function handle(Collection $records): bool
    {
        return $records->contains(function (Model $record) {
            return Auth::user()->is($record);
        });
    }
}
