<?php

namespace Kumi\Norikumi\Http\Saloon\Connectors\OneBrickTokenConnector\Actions;

use Kumi\Norikumi\Http\Saloon\Connectors\OneBrickTokenConnector\Requests\GetTokenRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class InitializeAccessToken
{
    use AsAction;

    public function handle()
    {
        $request = new GetTokenRequest();
        $response = $request->send();
        $data = $response->json();

        return $data['data']['access_token'];
    }
}
