<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\Tables\Actions;

use Filament\Forms;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Norikumi\Actions\ValidatePayrollActivationRequest;
use Kumi\Norikumi\Events\Payroll\Activated;
use Kumi\Norikumi\Support\DefaultPermissions;

class ActivateBulkAction extends BulkAction
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('norikumi::filament/resources/payroll.actions.activate.multiple.label'));

        $this->form([
            Forms\Components\DatePicker::make('activated_at')
                ->label(__('norikumi::filament/resources/payroll.fields.activated_at.label'))
                ->displayFormat('d F Y')
                ->closeOnDateSelection()
                ->required(),
        ]);

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/payroll.actions.activate.multiple.modal.heading', ['label' => $this->getPluralModelLabel()]));

        $this->modalButton(__('norikumi::filament/resources/payroll.actions.activate.multiple.modal.actions.activate.label'));

        $this->successNotificationTitle(__('norikumi::filament/resources/payroll.actions.activate.multiple.messages.activated'));

        $this->color('success');

        $this->icon('heroicon-s-check');

        $this->requiresConfirmation();

        $this->action(function (array $data): void {
            $this->process(static function (Collection $records) use ($data) {
                $records
                    ->reject->isActivated()
                    ->each(function (Model $record) use ($data) {
                        [$isValid, $message] = ValidatePayrollActivationRequest::run($record);

                        if (! $isValid) {
                            return;
                        }

                        $record->markAsActivated($data['activated_at']);

                        Activated::dispatch($record);
                    })
                ;
            });

            $this->success();
        });

        $this->deselectRecordsAfterCompletion();

        $this->visible(function () {
            return Auth::user()->can(DefaultPermissions::ACTIVATE_ANY_PAYROLLS);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'activate';
    }
}
