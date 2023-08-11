<?php

namespace Kumi\Sousa\Http\Saloon\Connectors;

use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Kumi\Sousa\Http\Saloon\Connectors\GeoTrackTokenConnector\Actions\InitializeAccessToken;

class GeoTrackConnector extends SaloonConnector
{
    use AcceptsJson;

    /**
     * The Base URL of the API.
     */
    public function defineBaseUrl(): string
    {
        return 'http://geotrack.asia/comGpsGate/api/v.1/applications/16';
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
            'Authorization' => $accessToken,
        ];
    }

    /**
     * The config options that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultConfig(): array
    {
        return [];
    }
}
