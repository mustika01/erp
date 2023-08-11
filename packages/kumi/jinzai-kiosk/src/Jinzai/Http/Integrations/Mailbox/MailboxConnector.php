<?php

namespace Kumi\Jinzai\Http\Integrations\Mailbox;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Sammyjo20\Saloon\Http\SaloonConnector;
use Sammyjo20\Saloon\Traits\Plugins\AcceptsJson;

class MailboxConnector extends SaloonConnector
{
    use AcceptsJson;

    /**
     * The Base URL of the API.
     */
    public function defineBaseUrl(): string
    {
        return App::isLocal() || App::runningUnitTests()
            ? Config::get('services.inspector.url')
            : 'https://app.1mail.id/api';
    }

    /**
     * The headers that will be applied to every request.
     *
     * @return string[]
     */
    public function defaultHeaders(): array
    {
        $token = config('services.1mail.token');

        return [
            'Authorization' => "Bearer {$token}",
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
