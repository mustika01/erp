<?php

namespace Kumi\Kanri\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Kanri\Support\DefaultPermissions;

class GenerateAuthorizedReportableType
{
    use AsAction;

    public function handle(): Collection
    {
        $collection = Collection::make([
            DefaultPermissions::VIEW_ANY_PAYOUT_REPORTS => \Kumi\Jinzai\Models\Payout::class,
            DefaultPermissions::VIEW_ANY_VOYAGE_SUMMARY_REPORTS => \Kumi\Sousa\Models\VesselVoyage::class,
            DefaultPermissions::VIEW_ANY_DOCKING_SCHEDULE_REPORTS => 'docking-schedule',
        ]);

        if (Auth::user()->can(DefaultPermissions::VIEW_ANY_REPORTS)) {
            $collection = $collection;
        } else {
            $collection = $collection->filter(function ($type, $permission) {
                return Auth::user()->can($permission);
            });
        }

        return $collection;
    }
}
