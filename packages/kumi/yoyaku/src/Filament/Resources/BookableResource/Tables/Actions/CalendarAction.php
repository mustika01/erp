<?php

namespace Kumi\Yoyaku\Filament\Resources\BookableResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Kumi\Yoyaku\Filament\Pages\BookableCalendar;

class CalendarAction extends Action
{
    public function setUp(): void
    {
        $this->color('danger');

        $this->icon('heroicon-s-calendar');

        $this->label(__('yoyaku::filament/resources/bookable.actions.calendar.label'));

        $this->url(function (Model $record) {
            return BookableCalendar::getUrl(['bookable' => $record]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'calendar';
    }
}
