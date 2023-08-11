<?php

namespace Kumi\Sousa\Filament\Resources\BunkerJournalResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Sousa\Filament\Resources\BunkerJournalResource;

class CommitAction extends Action
{
    public function setUp(): void
    {
        $this->color('success');

        $this->icon('heroicon-s-check');

        $this->label(__('sousa::filament/resources/bunker-journal.actions.commit.label'));

        $this->modalHeading(fn (): string => __('sousa::filament/resources/bunker-journal.actions.commit.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->visible(function (Model $record) {
            return ! $record->isCommitted() && $record->isEarliestUncommittedJournal();
        });

        $this->authorize(function (Model $record) {
            return BunkerJournalResource::canEdit($record);
        });

        $this->requiresConfirmation();

        $this->action(function (Model $record) {
            $bunker = $record->bunker;

            $record->update([
                'rob_amount' => $bunker->rob_amount,
                'remainder' => $bunker->rob_amount + $record->refuel - $record->real_time_usage,
                'committed_at' => Carbon::now(),
            ]);

            $bunker->update([
                'rob_amount' => $record->remainder,
            ]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'commit';
    }
}
