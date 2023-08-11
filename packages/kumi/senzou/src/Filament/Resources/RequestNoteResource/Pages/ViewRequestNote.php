<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages;

use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Kumi\Senzou\Filament\Resources\RequestNoteResource;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages\Actions\ApproveRequestNoteAction;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages\Actions\EditDateRequestNoteAction;
use Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages\Actions\RejectRequestNoteAction;
use Kumi\Senzou\Support\DefaultPermissions;

class ViewRequestNote extends ViewRecord
{
    protected static string $resource = RequestNoteResource::class;

    protected function getActions(): array
    {
        $actions = [];

        Collection::make([
            DefaultPermissions::APPROVE_REQUEST_NOTES => $this->getApproveRequestNoteAction(),
            DefaultPermissions::REJECT_REQUEST_NOTES => $this->getRejectRequestNoteAction(),
            DefaultPermissions::EDIT_DATE_REQUEST_NOTE => $this->getEditDateRequestNoteAction(),
        ])->each(function ($action, $permission) use (&$actions) {
            $user = Auth::user();

            if ($user->can($permission)) {
                $actions[] = $action;
            }
        });

        return array_merge($actions, parent::getActions());
    }

    protected function getEditDateRequestNoteAction()
    {
        return EditDateRequestNoteAction::make()
            ->record($this->getRecord())
        ;
    }

    protected function getApproveRequestNoteAction()
    {
        return ApproveRequestNoteAction::make()
            ->record($this->getRecord())
        ;
    }

    protected function getRejectRequestNoteAction()
    {
        return RejectRequestNoteAction::make()
            ->record($this->getRecord())
        ;
    }
}
