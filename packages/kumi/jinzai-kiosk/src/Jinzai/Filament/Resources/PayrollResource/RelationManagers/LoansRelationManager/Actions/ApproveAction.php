<?php

namespace Kumi\Jinzai\Filament\Resources\PayrollResource\RelationManagers\LoansRelationManager\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Filament\Tables\Actions\Concerns;
use Illuminate\Database\Eloquent\Model;
use Kumi\Jinzai\Support\DefaultPermissions;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class ApproveAction extends Action
{
    use CanCustomizeProcess;
    use Concerns\InteractsWithRelationship;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('jinzai::filament/resources/loan.actions.approve.single.label'));

        $this->modalHeading(fn (): string => __('jinzai::filament/resources/loan.actions.approve.single.modal.heading', ['label' => $this->getModelLabel()]));

        $this->modalButton(__('jinzai::filament/resources/loan.actions.approve.single.modal.actions.approve.label'));

        $this->successNotificationMessage(__('jinzai::filament/resources/loan.actions.approve.single.messages.approved'));

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
            return Auth::user()->can(DefaultPermissions::APPROVE_LOAN)
                && ! $record->isApproved()
                && ! $record->isExpired();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'approve';
    }
}
