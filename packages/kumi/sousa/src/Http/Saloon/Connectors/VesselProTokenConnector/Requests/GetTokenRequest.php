<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\VesselProTokenConnector\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasFormParams;
use Kumi\Sousa\Http\Saloon\Connectors\VesselProTokenConnector;

class GetTokenRequest extends SaloonRequest
{
    use HasFormParams;

    protected ?string $connector = VesselProTokenConnector::class;

    protected ?string $method = Saloon::POST;

    public function __construct(
        public string $username,
        public string $password,
        public string $database = 'JKT_LIVE',
        public string $grantType = 'password',
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/token';
    }

    public function defaultData(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'db' => $this->database,
            'grant_type' => $this->grantType,
        ];
    }
}
