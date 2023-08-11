<?php

namespace Kumi\Sousa\Filament\Resources\VesselDocumentResource\Pages\Actions;

use Filament\Pages\Actions\Action;

class DownloadExpiringDocumentsAction extends Action
{
    public function setUp(): void
    {
        $this->button();

        $this->color('secondary');

        $this->label(__('sousa::filament/resources/vessel-document.actions.download-expiring-documents.label'));
    }

    public static function getDefaultName(): ?string
    {
        return 'download-expiring-documents';
    }
}
