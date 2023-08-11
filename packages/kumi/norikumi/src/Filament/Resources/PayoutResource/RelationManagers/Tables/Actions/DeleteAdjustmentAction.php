<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Models\PayoutItem;
use Livewire\Component as Livewire;

class DeleteAdjustmentAction extends DeleteAction
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('norikumi::filament/resources/payout-item.actions.adjustments.delete.single.label'));

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/payout-item.actions.adjustments.delete.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('norikumi::filament/resources/payout-item.actions.adjustments.delete.single.modal.actions.delete.label'));

        $this->successNotificationMessage(__('norikumi::filament/resources/payout-item.actions.adjustments.delete.single.messages.deleted'));

        $this->color('danger');

        $this->icon('heroicon-s-trash');

        $this->requiresConfirmation();

        $this->hidden(static function (Model $record): bool {
            if (! method_exists($record, 'trashed')) {
                return false;
            }

            return $record->trashed();
        });

        $this->action(function (Model $record): void {
            $this->process(static fn (Model $record) => $record->delete());

            $this->success();

            $this->redirect(PayoutResource::getUrl('view', [$record->payout]));
        });

        $this->visible(function (Livewire $livewire, Model $record) {
            return $livewire->getOwnerRecord()->approvals()->count() === 0
                && (
                    $record->type === PayoutItem::TYPE_ADJUSTMENT
                    || $record->type === PayoutItem::TYPE_ATTENDANCE
                );
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'delete';
    }
}
