<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Closure;
use Livewire\Component as Livewire;
use Filament\Tables\Actions\Concerns;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\CreateAction;
use Kumi\Jinzai\Actions\CalculateSalaryAdjustment;
use Kumi\Jinzai\Actions\CalculateSalaryAttendance;
use Kumi\Jinzai\Filament\Resources\PayoutResource;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Schemas\InteractsWithPayoutItemAdjustmentSchema;

class CreateAdjustmentAction extends CreateAction
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;
    use InteractsWithPayoutItemAdjustmentSchema;

    protected bool|Closure $isCreateAnotherDisabled = true;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(fn (): string => __('jinzai::filament/resources/payout-item.actions.adjustments.create.single.label', ['label' => $this->getModelLabel()]));

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/payout-item.actions.adjustments.create.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->modalButton(__('jinzai::filament/resources/payout-item.actions.adjustments.create.single.modal.actions.create.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/payout-item.actions.adjustments.create.single.messages.created'));

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
