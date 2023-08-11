<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\Tables\Actions;

use Kumi\Jinzai\Models\Approval;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Events\Payout\Approved;
use Kumi\Jinzai\Support\DefaultPermissions;
use Illuminate\Database\Eloquent\Collection;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class ApproveBulkAction extends BulkAction
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('jinzai::filament/resources/payout.actions.approve.multiple.label'));

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/payout.actions.approve.multiple.modal.heading', ['label' => $this->getPluralModelLabel()]));

        $this->modalButton(__('jinzai::filament/resources/payout.actions.approve.multiple.modal.actions.approve.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/payout.actions.approve.multiple.messages.approved'));

        $this->color('success');

        $this->icon('heroicon-s-check');

        $this->requiresConfirmation();

        $this->action(function (array $data): void {
            $this->process(static function (Collection $records) {
                $records
                    ->reject(function (Model $record) {
                        return $record->approvals->contains(function (Approval $approval) {
                            return $approval->user->is(Auth::user());
                        });
                    })
                    ->each(function (Model $record) {
                        $approval = new Approval([
                            'user_id' => Auth::user()->id,
                        ]);

                        $record->approvals()->save($approval);

                        Approved::dispatch($record);
                    })
                ;
            });

            $this->success();
        });

        $this->deselectRecordsAfterCompletion();

        $this->visible(function () {
            return Auth::user()->can(DefaultPermissions::APPROVE_ANY_PAYOUTS);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'approve';
    }
}
