<?php

namespace Kumi\Norikumi\Filament\Resources\RegistrationFormEntryResource\Tables\Actions;

use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\DeleteAction;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;

class ArchiveAction extends DeleteAction
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('norikumi::filament/resources/registration-form-entry.actions.archive.single.label'));

        $this->modalHeading(fn (): string => __('norikumi::filament/resources/registration-form-entry.actions.archive.single.modal.heading', ['label' => $this->getRecordTitle()]));

        $this->modalButton(__('norikumi::filament/resources/registration-form-entry.actions.archive.single.modal.actions.archive.label'));

        $this->successNotificationMessage(__('norikumi::filament/resources/registration-form-entry.actions.archive.single.messages.archived'));

        $this->color('warning');

        $this->icon('heroicon-s-archive');

        $this->requiresConfirmation();

        $this->visible(function (Model $record) {
            return $record->isCompleted();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'archive';
    }
}
