<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\Pages\Actions;

use Filament\Forms;
use Filament\Pages\Actions\Action;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Jinzai\Actions\ValidatePayrollActivationRequest;
use Kumi\Jinzai\Events\Payroll\Activated;
use Kumi\Jinzai\Support\DefaultPermissions;

class ActivateAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('jinzai::filament/resources/payroll.actions.activate.single.label'));

        $this->form([
            Forms\Components\DatePicker::make('activated_at')
                ->label(__('jinzai::filament/resources/payroll.fields.activated_at.label'))
                ->displayFormat('d F Y')
                ->closeOnDateSelection()
                ->required(),
        ]);

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/payroll.actions.activate.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->modalButton(__('jinzai::filament/resources/payroll.actions.activate.single.modal.actions.activate.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/payroll.actions.activate.single.messages.activated'));

        $this->color('success');

        $this->requiresConfirmation();

        $this->action(function (array $data, Model $record): void {
            [$isValid, $message] = ValidatePayrollActivationRequest::run($record);

            if (! $isValid) {
                $this->failureNotificationMessage($message);
                $this->failure();

                return;
            }

            $this->process(function () use ($data, $record) {
                $record->markAsActivated($data['activated_at']);

                Activated::dispatch($record);
            });

            $this->success();
        });

        $this->visible(function (?Model $record) {
            return Auth::user()->can(DefaultPermissions::ACTIVATE_PAYROLL)
                && $record
                && ! $record->isActivated();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'activate';
    }
}
