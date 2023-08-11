<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Senzou\Events\RequestNote\Committed;
use Kumi\Senzou\Support\Enums\RequestNoteItemStatus;

class RejectRequestNoteItemAction extends Action
{
    public function setUp(): void
    {
        $this->color('danger');

        $this->icon('heroicon-s-x');

        $this->label(__('senzou::filament/resources/request-note-item.columns.rejected.label'));

        $this->requiresConfirmation();

        $this->action(function (Model $record): void {
            $record->update([
                'committed_at' => Carbon::now(),
                'status' => RequestNoteItemStatus::REJECTED,
            ]);

            $this->success();

            Committed::dispatch($record);
        });

        $this->visible(function (Model $record) {
            return ! $record->isCommitted();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'rejected';
    }
}
