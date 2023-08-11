<?php

namespace Kumi\Sousa\Filament\Resources\BunkerResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Sousa\Filament\Pages\BunkerJournals;
use Kumi\Sousa\Support\DefaultPermissions;

class SolarAction extends Action
{
    public function setUp(): void
    {
        $this->color('success');

        $this->icon('heroicon-o-book-open');

        $this->label(__('sousa::filament/resources/bunker.actions.solar.label'));

        // $this->visible(function () {
        //     return Auth::user()->can(DefaultPermissions::VIEW_VESSEL_DASHBOARD);
        // });

        $this->url(function (Model $record) {
            return BunkerJournals::getUrl(['bunker' => $record]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'journals';
    }
}
