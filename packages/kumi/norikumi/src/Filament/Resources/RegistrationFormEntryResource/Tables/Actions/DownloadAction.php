<?php

namespace Kumi\Norikumi\Filament\Resources\RegistrationFormEntryResource\Tables\Actions;

use Maatwebsite\Excel\Excel;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Kumi\Norikumi\Data\Exports\RegistrationFormEntryExport;

class DownloadAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('norikumi::filament/resources/registration-form-entry.actions.download.single.label'));

        $this->color('success');

        $this->icon('heroicon-s-download');

        $this->action(function (Model $record) {
            return (new RegistrationFormEntryExport([$record]))->download('form.xlsx', Excel::XLSX, ['Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']);
        });

        $this->visible(function (Model $record) {
            return $record->isCompleted();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'download';
    }
}
