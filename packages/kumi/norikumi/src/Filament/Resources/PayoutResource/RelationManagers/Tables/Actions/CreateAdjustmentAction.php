<?php

namespace Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Filament\Forms\ComponentContainer;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Concerns;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Kumi\Norikumi\Actions\CalculateSalaryAdjustment;
use Kumi\Norikumi\Actions\CalculateSalaryAttendance;
use Kumi\Norikumi\Filament\Resources\PayoutResource;
use Kumi\Norikumi\Filament\Resources\PayoutResource\RelationManagers\Schemas\InteractsWithPayoutItemAdjustmentSchema;
use Livewire\Component as Livewire;

class CreateAdjustmentAction extends CreateAction
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;
    use InteractsWithPayoutItemAdjustmentSchema;

    protected bool|\Closure $isCreateAnotherDisabled = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn (): string => __('norikumi::filament/resources/payout-item.actions.adjustments.create.single.label', ['label' => $this->getModelLabel()]));

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/payout-item.actions.adjustments.create.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->modalButton(__('norikumi::filament/resources/payout-item.actions.adjustments.create.single.modal.actions.create.label'));

        $this->successNotificationMessage(__('norikumi::filament/resources/payout-item.actions.adjustments.create.single.messages.created'));

        $this->form($this->getPayoutItemAdjustmentSchema());

        $this->action(function (array $arguments, ComponentContainer $form, HasTable $livewire): void {
            $model = $this->getModel();

            $record = $this->process(function (array $data) use ($livewire): Model {
                $relationship = $this->getRelationship();

                $data = CalculateSalaryAdjustment::run($data, $livewire->getOwnerRecord());
                $data = CalculateSalaryAttendance::run($data);

                return $relationship->create($data);
            });

            $this->record($record);

            $form->model($record)->saveRelationships();

            $livewire->mountedTableActionRecord($record->getKey());

            $this->success();

            $this->redirect(PayoutResource::getUrl('view', [$livewire->getOwnerRecord()]));
        });

        $this->visible(function (Livewire $livewire) {
            return $livewire->getOwnerRecord()->approvals()->count() === 0;
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'create-adjustment';
    }
}
