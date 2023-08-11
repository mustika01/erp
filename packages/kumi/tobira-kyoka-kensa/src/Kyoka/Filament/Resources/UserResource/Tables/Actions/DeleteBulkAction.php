<?php

namespace Kumi\Kyoka\Filament\Resources\UserResource\Tables\Actions;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Kumi\Kyoka\Actions\User\CheckForLoggedInRecord;
use Filament\Tables\Actions\DeleteBulkAction as BaseDeleteBulkAction;

class DeleteBulkAction extends BaseDeleteBulkAction
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->action(function (): void {
            $this->process(function (Collection $records) {
                $hasLoggedInUser = CheckForLoggedInRecord::run($records);

                if ($hasLoggedInUser) {
                    $this->failureNotificationMessage = __('You can not delete yourself.');

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
