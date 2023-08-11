<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\GeoTrackTokenConnector\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Kumi\Sousa\Http\Saloon\Connectors\GeoTrackTokenConnector;

class GetTokenRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $connector = GeoTrackTokenConnector::class;

    protected ?string $method = Saloon::POST;

    public function __construct(
        public string $username,
        public string $password,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/tokens';
    }

    public function defaultData(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
        ];
    }
}
