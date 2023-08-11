<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Concerns;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Schemas\InteractsWithPayoutItemLoanSchema;
use Kumi\Norikumi\Models\PayoutItem;
use Kumi\Norikumi\Support\DefaultPermissions;
use Livewire\Component as Livewire;

class CreateLoanAction extends CreateAction
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;
    use InteractsWithPayoutItemLoanSchema;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn (): string => __('norikumi::filament/resources/payout-item.actions.loans.create.single.label', ['label' => $this->getModelLabel()]));

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/payout-item.actions.loans.create.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->modalButton(__('norikumi::filament/resources/payout-item.actions.loans.create.single.modal.actions.create.label'));

        $this->successNotificationMessage(__('norikumi::filament/resources/payout-item.actions.loans.create.single.messages.created'));

        $this->disableCreateAnother();

        $this->form($this->getPayoutItemLoanSchema());

        $this->mutateFormDataUsing(function (array $data): array {
            $data['type'] = PayoutItem::TYPE_LOAN;
            $data['amount'] = (int) $data['amount'] * -1;

            return $data;
        });

        $this->visible(function (Livewire $livewire) {
            $hasNoApprovals = $livewire->getOwnerRecord()->approvals()->count() === 0;
            $hasPermission = Auth::user()->can(DefaultPermissions::CREATE_LOAN_PAYOUT_ITEM);

            return $hasNoApprovals && $hasPermission;
        });

        $this->after(function (HasTable $livewire) {
            $this->redirect(PayoutResource::getUrl('view', [$livewire->getOwnerRecord()]));
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'create-loan';
    }
}
