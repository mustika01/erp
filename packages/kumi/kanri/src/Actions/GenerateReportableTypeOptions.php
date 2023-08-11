<?php

namespace Kumi\Kanri\Actions;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Kanri\Support\DefaultPermissions;

class GenerateReportableTypeOptions
{
    use AsAction;

    public function handle(): Collection
    {
        $collection = Collection::make([
            DefaultPermissions::CREATE_PAYOUT_REPORT => \Kumi\Jinzai\Models\Payout::class,
            DefaultPermissions::CREATE_VOYAGE_SUMMARY_REPORT => \Kumi\Sousa\Models\VesselVoyage::class,
            DefaultPermissions::CREATE_DOCKING_SCHEDULE_REPORT => 'docking-schedule',
        ]);

        return $collection->filter(function ($type, $permission) {
            return Auth::user()->can($permission);
        });
    }
}
