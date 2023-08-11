<?php

namespace Kumi\Kiosk\Actions;

use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Models\Approval;
use Kumi\Kiosk\Models\PersonalPayout;
use Illuminate\Database\Eloquent\Builder;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Kiosk\Support\Enums\PayoutStatus;

class RetrievePayoutApprovalStatus
{
    use AsAction;

    public function handle(PersonalPayout $payout): string
    {
        $count = Approval::query()->whereHasMorph(
            'approvable',
            [Payout::class],
            function (Builder $builder) use ($payout) {
                $builder->where('id', $payout->id);
            }
        )->count();

        return $count >= 3
            ? PayoutStatus::APPROVED
            : PayoutStatus::PENDING;
    }
}
