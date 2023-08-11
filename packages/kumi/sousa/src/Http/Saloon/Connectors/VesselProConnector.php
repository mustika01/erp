<?php

namespace Kumi\Sousa\Http\Saloon\Connectors;

use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Kumi\Sousa\Http\Saloon\Connectors\VesselProTokenConnector\Actions\InitializeAccessToken;

class VesselProConnector extends SaloonConnector
{
    use AcceptsJson;

    /**
     * The Base URL of the API.
     */
    public function defineBaseUrl(): string
    {
        return 'https://app2.indotrack.com/vesselpro';
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        $accessToken = InitializeAccessToken::run();

        return [
            'Authorization' => "Bearer {$accessToken}",
        ];
    }

    /**
     * The config options that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultConfig(): array
    {
        return [
            'timeout' => 300,
        ];
    }
}
