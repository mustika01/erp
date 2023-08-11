<?php

namespace Kumi\Sousa\Filament\Resources\VesselDocumentResource\Pages\Actions;

use Filament\Pages\Actions\Action;

class PreviewExpiringDocumentsAction extends Action
{
    public function setUp(): void
    {
        $this->button();

        $this->color('secondary');

        $this->label(__('sousa::filament/resources/vessel-document.actions.preview-expiring-documents.label'));

        $this->url(route('sousa.expiring-documents.preview'));

        $this->openUrlInNewTab();
    }

    public static function getDefaultName(): ?string
    {
        return 'preview-expiring-documents';
    }
}
