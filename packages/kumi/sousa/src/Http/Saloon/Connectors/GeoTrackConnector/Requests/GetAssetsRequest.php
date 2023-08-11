<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\GeoTrackConnector\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Kumi\Sousa\Http\Saloon\Connectors\GeoTrackConnector;

class GetAssetsRequest extends SaloonRequest
{
    protected ?string $connector = GeoTrackConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct()
    {
    }

    public function defineEndpoint(): string
    {
        return '/users';
    }
}
