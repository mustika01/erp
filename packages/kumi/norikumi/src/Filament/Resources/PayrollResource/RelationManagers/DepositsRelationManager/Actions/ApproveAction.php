<?php

namespace Kumi\Norikumi\Filament\Resources\PayrollResource\RelationManagers\DepositsRelationManager\Actions;

use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\Concerns;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Kumi\Norikumi\Support\DefaultPermissions;

class ApproveAction extends Action
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('norikumi::filament/resources/deposit.actions.approve.single.label'));

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/deposit.actions.approve.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->modalButton(__('norikumi::filament/resources/deposit.actions.approve.single.modal.actions.approve.label'));

        $this->successNotificationTitle(__('norikumi::filament/resources/deposit.actions.approve.single.messages.approved'));

        $this->color('success');

        $this->icon('heroicon-s-check');

        $this->requiresConfirmation();

        $this->action(function () {
            $this->process(function (Model $record) {
                $record->markAsApproved();
            });

            $this->success();
        });

        $this->successRedirectUrl(URL::previous());

        $this->visible(function (Model $record) {
            return Auth::user()->can(DefaultPermissions::APPROVE_DEPOSIT)
                && ! $record->isApproved()
            && ! $record->isExpired();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'approve';
    }
}
