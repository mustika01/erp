<?php

namespace Kumi\Sousa\Filament\Resources\BunkerResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Kumi\Sousa\Filament\Pages\OilJournals;

class OilAction extends Action
{
    public function setUp(): void
    {
        $this->color('warning');

        $this->icon('heroicon-o-book-open');

        $this->label(__('sousa::filament/resources/bunker.actions.oil.label'));

        $this->url(function (Model $record) {
            return OilJournals::getUrl(['bunker' => $record]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'oils';
    }
}
