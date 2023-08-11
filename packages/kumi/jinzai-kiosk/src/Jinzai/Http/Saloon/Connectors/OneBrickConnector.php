<?php

namespace Kumi\Jinzai\Http\Saloon\Connectors;

use Illuminate\Support\Facades\App;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickTokenConnector\Actions\InitializeAccessToken;

class OneBrickConnector extends SaloonConnector
{
    use AcceptsJson;

    /**
     * The Base URL of the API.
     */
    public function defineBaseUrl(): string
    {
        $environment = App::environment();

        return match ($environment) {
            'local' => 'https://sandbox.onebrick.io/v1',
            'production' => 'https://api.onebrick.io/v1',
            default => 'https://sandbox.onebrick.io/v1',
        };
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        $token = InitializeAccessToken::run();

        return [
            'Authorization' => "Bearer {$token}",
            'Content-Type' => 'application/json',
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
