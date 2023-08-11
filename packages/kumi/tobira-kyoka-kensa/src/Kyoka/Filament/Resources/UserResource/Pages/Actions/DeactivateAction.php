<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Pages\Actions;

use Illuminate\Http\Response;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Events\User\Deactivated;
use Kumi\Kyoka\Support\DefaultPermissions;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class DeactivateAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('kyoka::filament/resources/user.actions.deactivate.label'));

        $this->recordTitle(function (Model $record) {
            return $record->name;
        });

        $this->modalHeading(fn (): string => __('kyoka::filament/resources/user.actions.deactivate.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('kyoka::filament/resources/user.actions.deactivate.modal.actions.deactivate.label'));

        $this->successNotificationMessage(__('kyoka::filament/resources/user.actions.deactivate.messages.deactivated'));

        $this->color('danger');

        $this->requiresConfirmation();

        $this->hidden(static function (Model $record): bool {
            return ! $record->isActivated();
        });

        $this->action(function (): void {
            $this->process(static function (Model $record) {
                $canDeactivate = Auth::user()->can(DefaultPermissions::DEACTIVATE_USER);

                abort_unless($canDeactivate, Response::HTTP_FORBIDDEN);

                $record->disableLogging();
                $record->markUserAsInactive();

                Deactivated::dispatch($record);
            });

            $this->success();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'deactivate';
    }
}
