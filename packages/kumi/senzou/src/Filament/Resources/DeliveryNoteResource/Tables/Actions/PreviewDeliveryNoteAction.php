<?php

namespace Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;

class PreviewDeliveryNoteAction extends Action
{
    public function setUp(): void
    {
        $this->icon('heroicon-o-document');

        $this->color('primary');

        $this->label(__('senzou::filament/resources/delivery-note.actions.preview-delivery-notes.label'));

        $this->url(function (Model $record) {
            return route('senzou.delivery-notes.preview', [
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
        return 'preview-delivery-note';
    }
}
