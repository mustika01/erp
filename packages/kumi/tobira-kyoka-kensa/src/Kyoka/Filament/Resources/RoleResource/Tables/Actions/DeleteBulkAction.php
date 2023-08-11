<?php

namespace Kumi\Kyoka\Filament\Resources\RoleResource\Tables\Actions;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Actions\Role\CheckForNonEditableRecords;
use Filament\Tables\Actions\DeleteBulkAction as BaseDeleteBulkAction;

class DeleteBulkAction extends BaseDeleteBulkAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function (): void {
            $this->process(function (Collection $records) {
                $hasNonEditableRecord = CheckForNonEditableRecords::run($records);

                if ($hasNonEditableRecord) {
                    $this->failureNotificationMessage = __('Non editable records cannot be deleted.');

                    $this->failure();
                } else {
                    $records->each(function (Model $record) {
                        $record->delete();
                    });

                    $this->success();
                }
            });
        });
    }
}
