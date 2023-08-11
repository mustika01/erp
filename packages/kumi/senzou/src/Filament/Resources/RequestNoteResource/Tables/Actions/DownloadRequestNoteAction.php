<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Tables\Actions;

use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Senzou\Support\DefaultPermissions;

class DownloadRequestNoteAction extends Action
{
    public function setUp(): void
    {
        $this->icon('heroicon-o-download');

        $this->color('success');

        $this->label(__('senzou::filament/resources/request-note.actions.download.label'));

        $this->visible(function () {
            return Auth::user()->can(DefaultPermissions::DOWNLOAD_REQUEST_NOTE);
        });

        $this->url(function (Model $record) {
            return route('senzou.request-notes.download', [
                'record' => $record,
            ]);
        });

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'download-request-note';
    }
}
