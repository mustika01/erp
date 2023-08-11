<?php

namespace Kumi\Jinzai\Http\Saloon\Connectors;

use Illuminate\Support\Facades\App;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Traits\Auth\RequiresBasicAuth;

class OneBrickTokenConnector extends SaloonConnector
{
    use RequiresBasicAuth;
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
        return [];
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
