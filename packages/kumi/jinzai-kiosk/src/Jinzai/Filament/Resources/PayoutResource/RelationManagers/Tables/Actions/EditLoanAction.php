<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Filament\Forms\ComponentContainer;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Concerns;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Jinzai\Filament\Resources\PayoutResource;
use Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Schemas\InteractsWithPayoutItemLoanSchema;
use Kumi\Jinzai\Models\PayoutItem;
use Kumi\Jinzai\Support\DefaultPermissions;
use Livewire\Component as Livewire;

class EditLoanAction extends EditAction
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;
    use InteractsWithPayoutItemLoanSchema;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('jinzai::filament/resources/payout-item.actions.loans.edit.single.label'));

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/payout-item.actions.loans.edit.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('jinzai::filament/resources/payout-item.actions.loans.edit.single.modal.actions.save.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/payout-item.actions.loans.edit.single.messages.saved'));

        $this->form($this->getPayoutItemLoanSchema());

        $this->mutateFormDataUsing(function (array $data): array {
            $data['amount'] = (int) $data['amount'] * -1;

            return $data;
        });

        $this->visible(function (Livewire $livewire, Model $record) {
            $hasNoApprovals = $livewire->getOwnerRecord()->approvals()->count() === 0;
            $hasCorrectType = $record->type === PayoutItem::TYPE_LOAN;
            $hasPermission = Auth::user()->can(DefaultPermissions::UPDATE_LOAN_PAYOUT_ITEM);

            return $hasNoApprovals && $hasCorrectType && $hasPermission;
        });

        $this->mountUsing(fn (ComponentContainer $form) => $form->fill([
            'description' => $this->record->description,
            'amount' => $this->record->amount * -1,
            'remarks' => $this->record->remarks,
        ]));

        $this->after(function (Model $record) {
            $this->redirect(PayoutResource::getUrl('view', [$record->payout]));
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'edit';
    }
}
