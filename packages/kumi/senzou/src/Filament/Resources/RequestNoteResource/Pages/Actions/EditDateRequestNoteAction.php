<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages\Actions;

use Filament\Forms;
use Filament\Forms\ComponentContainer;
use Filament\Pages\Actions\Action;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Senzou\Support\DefaultPermissions;

class EditDateRequestNoteAction extends Action
{
    use CanCustomizeProcess;

    protected ?\Closure $mutateRecordDataUsing = null;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('senzou::filament/resources/request-note.actions.edit.label'));

        $this->color('warning');

        $this->modalWidth('sm');

        $this->visible(function () {
            return Auth::user()->can(DefaultPermissions::EDIT_DATE_REQUEST_NOTE);
        });

        $this->mountUsing(function (ComponentContainer $form, Model $record): void {
            $data = $record->attributesToArray();

            $form->fill($data);
        });

        $this->form([
            Forms\Components\DatePicker::make('created_at')
                ->label('Date')
                ->displayFormat('d F Y')
                ->closeOnDateSelection(),
        ]);

        $this->action(function (): void {
            $this->process(function (array $data, Model $record) {
                $record->update($data);
            });

            $this->success();
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'edit';
    }
}
