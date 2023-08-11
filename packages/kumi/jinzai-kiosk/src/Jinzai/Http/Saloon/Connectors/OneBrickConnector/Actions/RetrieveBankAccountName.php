<?php

namespace Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector\Requests\ValidateBankAccountRequest;

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
