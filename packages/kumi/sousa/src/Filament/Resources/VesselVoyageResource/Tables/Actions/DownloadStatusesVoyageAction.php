<?php

namespace Kumi\Sousa\Filament\Resources\VesselVoyageResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class DownloadStatusesVoyageAction extends Action
{
    public function setUp(): void
    {
        $this->icon('heroicon-o-download');

        $this->color('success');

        $this->label(__('sousa::filament/resources/voyage-status.actions.download.label'));

        $this->url(function (Model $record) {
            return route('sousa.statuses-voyage.download', [
                'record' => $record,
            ]);
        });

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'download-statuses-voyage';
    }
}
