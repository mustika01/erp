<?php

namespace Kumi\Senzou\Filament\Resources\DeliveryNoteResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Senzou\Filament\Resources\DeliveryNoteResource;

class CommitAction extends Action
{
    public function setUp(): void
    {
        $this->color('success');

        $this->icon('heroicon-s-check');

        $this->label(__('senzou::filament/resources/delivery-note.actions.commit.label'));

        $this->modalHeading(fn (): string => __('senzou::filament/resources/delivery-note.actions.commit.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->visible(function (Model $record) {
            return ! $record->isCommitted();
        });

        $this->authorize(function (Model $record) {
            return DeliveryNoteResource::canEdit($record);
        });

        $this->requiresConfirmation();

        $this->action(function (Model $record) {
            $record->update([
                'committed_at' => Carbon::now(),
            ]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'commit';
    }
}
