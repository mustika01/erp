<?php

namespace Kumi\Norikumi\Filament\Tables\ListVessels\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Kumi\Norikumi\Filament\Pages\ListVesselAssignments;

class AssignmentsAction extends Action
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->icon('heroicon-s-users');

        $this->url(function (Model $record) {
            return ListVesselAssignments::getUrl(['vessel' => $record]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'assignments';
    }
}
