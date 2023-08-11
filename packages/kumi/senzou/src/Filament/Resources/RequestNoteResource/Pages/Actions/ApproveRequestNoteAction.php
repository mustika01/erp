<?php

namespace Kumi\Senzou\Filament\Resources\RequestNoteResource\Pages\Actions;

use Carbon\Carbon;
use Filament\Pages\Actions\Action;
use Filament\Support\Actions\Concerns\CanCustomizeProcess;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Kumi\Senzou\Support\DefaultPermissions as SupportDefaultPermissions;
use Kumi\Senzou\Support\Enums\RequestNoteStatus;

class ApproveRequestNoteAction extends Action
{
    use CanCustomizeProcess;

    protected function setUp(): void
    {
        parent::setUp();

        $this->label(__('senzou::filament/resources/request-note.actions.approved.label'));

        $this->color('success');

        $this->requiresConfirmation();

        $this->visible(function (?Model $record) {
            return Auth::user()->can(SupportDefaultPermissions::APPROVE_REQUEST_NOTES)
                && ! $record->isApproved()
                && $record->status == RequestNoteStatus::IN_REVIEW;
        });

        $this->action(function (array $data, Model $record): void {
            $record->update([
                'approved_at' => Carbon::now(),
                'status' => RequestNoteStatus::FINALIZED,
            ]);
        });
    }

    public static function getDefaultName(): ?string
    {
        return 'approved';
    }
}
