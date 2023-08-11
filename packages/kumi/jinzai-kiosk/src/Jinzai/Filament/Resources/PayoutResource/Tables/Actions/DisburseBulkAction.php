<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\Tables\Actions;

use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Jobs\CreateDisbursementJob;
use Kumi\Jinzai\Support\DefaultPermissions;
use Illuminate\Database\Eloquent\Collection;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class DisburseBulkAction extends BulkAction
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('jinzai::filament/resources/payout.actions.disburse.multiple.label'));

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/payout.actions.disburse.multiple.modal.heading', ['label' => $this->getPluralModelLabel()]));

        $this->modalButton(__('jinzai::filament/resources/payout.actions.disburse.multiple.modal.actions.disburse.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/payout.actions.disburse.multiple.messages.disbursed'));

        $this->color('success');

        $this->icon('heroicon-s-cash');

        $this->requiresConfirmation();

        $this->action(function (array $data): void {
            $this->process(static function (Collection $records) {
                $records
                    ->each(function (Model $record) {
                        CreateDisbursementJob::dispatch($record);
                    })
                ;
            });

            $this->success();
        });

        $this->deselectRecordsAfterCompletion();

        $this->visible(function () {
            return Auth::user()->can(DefaultPermissions::DISBURSE_ANY_PAYOUTS);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'disburse';
    }
}
