<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Tables\Actions;

use Closure;
use Kumi\Jinzai\Models\PayoutItem;
use Livewire\Component as Livewire;
use Filament\Tables\Actions\Concerns;
use Filament\Forms\ComponentContainer;
use Filament\Tables\Actions\EditAction;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Actions\CalculateSalaryAdjustment;
use Kumi\Jinzai\Actions\CalculateSalaryAttendance;
use Kumi\Jinzai\Filament\Resources\PayoutResource;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Kumi\Jinzai\Filament\Resources\PayoutResource\RelationManagers\Schemas\InteractsWithPayoutItemAdjustmentSchema;

class EditAdjustmentAction extends EditAction
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;
    use InteractsWithPayoutItemAdjustmentSchema;

    protected ?Closure $mutateRecordDataUsing = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('jinzai::filament/resources/payout-item.actions.adjustments.edit.single.label'));

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/payout-item.actions.adjustments.edit.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('jinzai::filament/resources/payout-item.actions.adjustments.edit.single.modal.actions.save.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/payout-item.actions.adjustments.edit.single.messages.saved'));

        $this->icon('heroicon-s-pencil');

        $this->mountUsing(function (ComponentContainer $form, Model $record): void {
            $data = $record->toArray();

            if ($this->mutateRecordDataUsing) {
                $data = $this->evaluate($this->mutateRecordDataUsing, ['data' => $data]);
            }

            $form->fill($data);
        });

        $this->form($this->getPayoutItemAdjustmentSchema());

        $this->action(function (Model $record): void {
            $this->process(function (array $data, Model $record) {
                $data = CalculateSalaryAdjustment::run($data, $record->payout);
                $data = CalculateSalaryAttendance::run($data);

                $record->update($data);
            });

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
        return 'edit';
    }
}
