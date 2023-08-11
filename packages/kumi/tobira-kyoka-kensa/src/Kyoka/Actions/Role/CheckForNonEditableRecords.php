<?php

namespace Kumi\Kyoka\Actions\Role;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Lorisleiva\Actions\Concerns\AsAction;

class CheckForNonEditableRecords
{
    use AsAction;

    public function handle(Collection $records): bool
    {
        return $records->contains(function (Model $record) {
            return ! $record->is_editable;
        });
    }
}
