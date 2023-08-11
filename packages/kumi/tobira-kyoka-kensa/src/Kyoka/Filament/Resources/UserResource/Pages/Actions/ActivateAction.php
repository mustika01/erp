<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Pages\Actions;

use Illuminate\Http\Response;
use Filament\Pages\Actions\Action;
use Illuminate\Support\Facades\Auth;
use Kumi\Kyoka\Events\User\Activated;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Support\DefaultPermissions;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class ActivateAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('kyoka::filament/resources/user.actions.activate.label'));

        $this->modalHeading(fn (): string => __('kyoka::filament/resources/user.actions.activate.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('kyoka::filament/resources/user.actions.activate.modal.actions.activate.label'));

        $this->successNotificationMessage(__('kyoka::filament/resources/user.actions.activate.messages.activated'));

        $this->color('success');

        $this->requiresConfirmation();

        $this->hidden(static function (Model $record): bool {
            return $record->isActivated();
        });

        $this->action(function (): void {
            $this->process(static function (Model $record) {
                $canActivate = Auth::user()->can(DefaultPermissions::ACTIVATE_USER);

                abort_unless($canActivate, Response::HTTP_FORBIDDEN);

                $record->disableLogging();
                $record->markUserAsActive();

                Activated::dispatch($record);
            });

            $this->success();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'activate';
    }
}
