<?php

namespace Kumi\Sousa\Filament\Resources\VesselDocumentResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\ListRecords;
use Kumi\Sousa\Support\DefaultPermissions;
use Kumi\Sousa\Filament\Resources\VesselDocumentResource;
use Kumi\Sousa\Filament\Resources\VesselDocumentResource\Pages\Actions\PreviewExpiringDocumentsAction;
use Kumi\Sousa\Filament\Resources\VesselDocumentResource\Pages\Actions\DownloadExpiringDocumentsAction;

class ListVesselDocuments extends ListRecords
{
    protected static string $resource = VesselDocumentResource::class;

    protected function getActions(): array
    {
        // Actions\CreateAction::make(),

        $actions = Collection::make([
            DefaultPermissions::PREVIEW_EXPIRING_DOCUMENTS => $this->getPreviewExpiringDocumentsAction(),
            DefaultPermissions::DOWNLOAD_EXPIRING_DOCUMENTS => $this->getDownloadExpiringDocumentsAction(),
        ])->filter(function ($action, $permission) {
            return Auth::user()->can($permission);
        })->toArray();

        return array_merge($actions, parent::getActions());
    }

    protected function getPreviewExpiringDocumentsAction()
    {
        return PreviewExpiringDocumentsAction::make()
            ->url(route('sousa.expiring-documents.preview'))
            ->openUrlInNewTab()
        ;
    }

    protected function getDownloadExpiringDocumentsAction()
    {
        return DownloadExpiringDocumentsAction::make()
            ->url(route('sousa.expiring-documents.download'))
            ->openUrlInNewTab()
        ;
    }
}
