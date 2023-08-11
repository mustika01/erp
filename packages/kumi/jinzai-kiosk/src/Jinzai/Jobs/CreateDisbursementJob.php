<?php

namespace Kumi\Jinzai\Jobs;

use Illuminate\Support\Str;
use Kumi\Jinzai\Models\Bank;
use Illuminate\Bus\Queueable;
use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Models\Disbursement;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector\Requests\CreateDisbursementRequest;

class CreateDisbursementJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected const TOTAL_APPROVALS_COUNT = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected Payout $payout
    ) {
    }

    /**
     * Execute the job.
     */
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
