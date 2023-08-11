<?php

namespace Kumi\Sousa\Filament\Resources\OilJournalResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Kumi\Sousa\Filament\Resources\OilJournalResource;

class CommitAction extends Action
{
    public function setUp(): void
    {
        $this->color('success');

        $this->icon('heroicon-s-check');

        $this->label(__('sousa::filament/resources/oil-journal.actions.commit.label'));

        $this->modalHeading(fn (): string => __('sousa::filament/resources/oil-journal.actions.commit.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->visible(function (Model $record) {
            return ! $record->isCommitted() && $record->isEarliestUncommittedJournal();
        });

        $this->authorize(function (Model $record) {
            return OilJournalResource::canEdit($record);
        });

        $this->requiresConfirmation();

        $this->action(function (Model $record) {
            $bunker = $record->bunker;

            $record->update([
                'rob_amount_type_90' => $bunker->type_90_amount,
                'remainder_type_90' => $bunker->type_90_amount + $record->refuel_type_90 - $record->total_usage_type_90,
                'rob_amount_type_40' => $bunker->type_40_amount,
                'remainder_type_40' => $bunker->type_40_amount + $record->refuel_type_40 - $record->total_usage_type_40,
                'rob_amount_type_10' => $bunker->type_10_amount,
                'remainder_type_10' => $bunker->type_10_amount + $record->refuel_type_10 - $record->total_usage_type_10,
                'committed_at' => Carbon::now(),
            ]);

            $bunker->update([
                'type_90_amount' => $record->remainder_type_90,
                'type_40_amount' => $record->remainder_type_40,
                'type_10_amount' => $record->remainder_type_10,
            ]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'commit';
    }
}
