<?php

namespace Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class DownloadDeliveryNoteAction extends Action
{
    public function setUp(): void
    {
        $this->icon('heroicon-o-download');

        $this->color('success');

        $this->label(__('senzou::filament/resources/delivery-note.actions.download-delivery-notes.label'));

        $this->url(function (Model $record) {
            return route('senzou.delivery-notes.download', [
                'record' => $record,
            ]);
        });

        $this->openUrlInNewTab();

        $this->visible(function (Model $record) {
            return $record->isCommitted();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'download-delivery-note';
    }
}
