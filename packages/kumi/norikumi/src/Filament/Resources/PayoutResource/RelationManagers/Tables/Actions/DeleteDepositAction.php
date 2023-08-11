<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Models\PayoutItem;
use Kumi\Norikumi\Support\DefaultPermissions;
use Livewire\Component as Livewire;

class DeleteDepositAction extends DeleteAction
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('norikumi::filament/resources/payout-item.actions.loans.delete.single.label'));

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/payout-item.actions.loans.delete.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('norikumi::filament/resources/payout-item.actions.loans.delete.single.modal.actions.delete.label'));

        $this->successNotificationMessage(__('norikumi::filament/resources/payout-item.actions.loans.delete.single.messages.deleted'));

        $this->color('danger');

        $this->icon('heroicon-s-trash');

        $this->requiresConfirmation();

        $this->visible(function (Livewire $livewire, Model $record) {
            $hasNoApprovals = $livewire->getOwnerRecord()->approvals()->count() === 0;
            $hasCorrectType = $record->type === PayoutItem::TYPE_DEPOSIT_RETURNED;
            $hasPermission = Auth::user()->can(DefaultPermissions::DELETE_DEPOSIT_PAYOUT_ITEM);

            return $hasNoApprovals && $hasCorrectType && $hasPermission;
        });

        $this->after(function (Model $record) {
            $this->redirect(PayoutResource::getUrl('view', [$record->payout]));
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'delete-deposit';
    }
}
