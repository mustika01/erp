<?php

namespace Kumi\Norikumi\Http\Saloon\Connectors\OneBrickConnector\Actions;

use Kumi\Norikumi\Http\Saloon\Connectors\OneBrickConnector\Requests\ValidateBankAccountRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class RetrieveBankAccountName
{
    use AsAction;

    public function handle(string $accountNumber, string $bankShortCode): string
    {
        $request = new ValidateBankAccountRequest($accountNumber, $bankShortCode);
        $response = $request->send();
        $data = $response->json();

        return $data['data']['accountName'];
    }
}
