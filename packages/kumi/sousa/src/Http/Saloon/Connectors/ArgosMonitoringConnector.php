<?php

namespace Kumi\Sousa\Http\Saloon\Connectors;

use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;
use Sammyjo20\Saloon\Traits\Plugins\DisablesSSLVerification;
use Kumi\Sousa\Http\Saloon\Connectors\ArgosMonitoringConnector\Actions\RetrieveCredentials;

class ArgosMonitoringConnector extends SaloonConnector
{
    use AcceptsJson;
    use DisablesSSLVerification;

    /**
     * The Base URL of the API.
     */
    public function defineBaseUrl(): string
    {
        return 'https://www.vms.web.id/vmap/api';
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

    /**
     * Default data.
     */
    public function defaultQuery(): array
    {
        $credentials = RetrieveCredentials::run();

        return [
            'user' => $credentials['username'],
            'pass' => $credentials['password'],
        ];
    }
}
