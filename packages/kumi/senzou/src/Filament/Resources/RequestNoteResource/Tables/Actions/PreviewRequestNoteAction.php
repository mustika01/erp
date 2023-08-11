<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Senzou\Support\DefaultPermissions;

class PreviewRequestNoteAction extends Action
{
    public function setUp(): void
    {
        $this->icon('heroicon-o-document');

        $this->color('primary');

        $this->label(__('senzou::filament/resources/request-note.actions.preview.label'));

        $this->visible(function () {
            return Auth::user()->can(DefaultPermissions::PREVIEW_REQUEST_NOTE);
        });

        $this->url(function (Model $record) {
            return route('senzou.request-notes.preview', [
                'record' => $record,
            ]);
        });

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'preview-request-note';
    }
}
