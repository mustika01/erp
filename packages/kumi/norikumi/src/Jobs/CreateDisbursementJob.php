<?php

namespace Kumi\Norikumi\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;
use Kumi\Norikumi\Http\Saloon\Connectors\OneBrickConnector\Requests\CreateDisbursementRequest;
use Kumi\Norikumi\Models\Bank;
use Kumi\Norikumi\Models\Disbursement;
use Kumi\Norikumi\Models\Payout;

class CreateDisbursementJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected const TOTAL_APPROVALS_COUNT = 3;

    public function __construct(
        protected Payout $payout
    ) {
    }

    public function handle()
    {
        $payout = $this->payout;

        if (
            $payout->approvals()->count() >= self::TOTAL_APPROVALS_COUNT
            && $payout->hasNoPendingDisbursement()
            && $payout->hasNoCompletedDisbursement()
        ) {
            $bank = $payout->payroll->primaryBank;

            if (! $bank) {
                return;
            }

            $data = $this->buildPayoutPayload($payout, $bank);

            $this->sendCreateDisbursementRequest($data);
        }
    }

    protected function buildPayoutPayload(Payout $payout, Bank $bank): array
    {
        $takeHomePayAmount = $payout->take_home_pay_amount;
        $referenceId = (string) Str::uuid();
        $description = $payout->description;
        $disbursementMethod = [
            'type' => 'bank_transfer',
            'bankShortCode' => $bank->bank_name,
            'bankAccountNo' => $bank->account_number,
            'bankAccountHolderName' => $bank->account_holder_name,
        ];

        return [
            'amount' => $takeHomePayAmount,
            'referenceId' => $referenceId,
            'description' => $description,
            'disbursementMethod' => $disbursementMethod,
        ];
    }

    protected function sendCreateDisbursementRequest(array $payload): void
    {
        $request = new CreateDisbursementRequest($payload);
        $response = $request->send();
        $status = $response->status();

        if ($status >= 400) {
            return;
        }

        $data = $response->json()['data'];
        $attributes = $data['attributes'];

        $disbursement = new Disbursement([
            'amount' => (int) $attributes['amount'],
            'reference_id' => $attributes['referenceId'],
            'description' => $attributes['description'],
            'disbursement_method' => $attributes['disbursementMethod'],

            'vendor_assigned_id' => $data['id'],
            'status' => $attributes['status'],
            'create_response' => $response->json(),
        ]);

        $this->payout->disbursements()->save($disbursement);
    }
}
