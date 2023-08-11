<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Concerns;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Schemas\InteractsWithPayoutItemDepositSchema;
use Kumi\Norikumi\Models\PayoutItem;
use Kumi\Norikumi\Support\DefaultPermissions;
use Livewire\Component as Livewire;

class CreateDepositAction extends CreateAction
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;
    use InteractsWithPayoutItemDepositSchema;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn (): string => __('norikumi::filament/resources/payout-item.actions.deposits.create.single.label', ['label' => $this->getModelLabel()]));

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/payout-item.actions.deposits.create.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->modalButton(__('norikumi::filament/resources/payout-item.actions.deposits.create.single.modal.actions.create.label'));

        $this->successNotificationMessage(__('norikumi::filament/resources/payout-item.actions.deposits.create.single.messages.created'));

        $this->disableCreateAnother();

        $this->form($this->getPayoutItemDepositSchema());

        $this->mutateFormDataUsing(function (array $data): array {
            $data['type'] = PayoutItem::TYPE_DEPOSIT_RETURNED;
            $data['amount'] = (int) $data['amount'];

            return $data;
        });

        $this->visible(function (Livewire $livewire) {
            $hasNoApprovals = $livewire->getOwnerRecord()->approvals()->count() === 0;
            $hasPermission = Auth::user()->can(DefaultPermissions::CREATE_DEPOSIT_PAYOUT_ITEM);

            return $hasNoApprovals && $hasPermission;
        });

        $this->after(function (HasTable $livewire) {
            $this->redirect(PayoutResource::getUrl('view', [$livewire->getOwnerRecord()]));
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'create-deposit';
    }
}
