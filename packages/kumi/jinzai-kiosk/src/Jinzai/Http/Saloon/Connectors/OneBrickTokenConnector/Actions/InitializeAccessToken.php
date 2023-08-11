<?php

namespace Kumi\Jinzai\Http\Saloon\Connectors\OneBrickTokenConnector\Actions;

use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickTokenConnector\Requests\GetTokenRequest;

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
