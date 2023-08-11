<?php

namespace Kumi\Sousa\Filament\Resources\VesselResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Support\DefaultPermissions;
use Kumi\Sousa\Filament\Pages\VesselDashboard;

class DashboardAction extends Action
{
    public function setUp(): void
    {
        $this->color('danger');

        $this->icon('heroicon-s-home');

        $this->label(__('sousa::filament/resources/vessel.actions.dashboard.label'));

        $this->visible(function () {
            return Auth::user()->can(DefaultPermissions::VIEW_VESSEL_DASHBOARD);
        });

        $this->url(function (Model $record) {
            return VesselDashboard::getUrl(['vessel' => $record]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'dashboard';
    }
}
