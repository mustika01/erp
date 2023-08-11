<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Kumi\Jinzai\Models\PayoutItem;
use Livewire\Component as Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\DeleteAction;
use Kumi\Jinzai\Support\DefaultPermissions;
use Kumi\Jinzai\Filament\Resources\PayoutResource;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class DeleteLoanAction extends DeleteAction
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('jinzai::filament/resources/payout-item.actions.loans.delete.single.label'));

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/payout-item.actions.loans.delete.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('jinzai::filament/resources/payout-item.actions.loans.delete.single.modal.actions.delete.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/payout-item.actions.loans.delete.single.messages.deleted'));

        $this->color('danger');

        $this->icon('heroicon-s-trash');

        $this->requiresConfirmation();

        $this->visible(function (Livewire $livewire, Model $record) {
            $hasNoApprovals = $livewire->getOwnerRecord()->approvals()->count() === 0;
            $hasCorrectType = $record->type === PayoutItem::TYPE_LOAN;
            $hasPermission = Auth::user()->can(DefaultPermissions::DELETE_LOAN_PAYOUT_ITEM);

            return $hasNoApprovals && $hasCorrectType && $hasPermission;
        });

        $this->after(function (Model $record) {
            $this->redirect(PayoutResource::getUrl('view', [$record->payout]));
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'delete-loan';
    }
}
