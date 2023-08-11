<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class PreviewStatusesVoyageAction extends Action
{
    public function setUp(): void
    {
        $this->icon('heroicon-o-document');

        $this->color('primary');

        $this->label(__('sousa::filament/resources/voyage-status.actions.preview.label'));

        $this->url(function (Model $record) {
            return route('sousa.statuses-voyage.preview', [
                'record' => $record,
            ]);
        });

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'preview-statuses-voyage';
    }
}
