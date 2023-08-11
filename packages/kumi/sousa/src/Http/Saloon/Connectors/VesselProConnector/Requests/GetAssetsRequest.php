<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\VesselProConnector\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Kumi\Sousa\Http\Saloon\Connectors\VesselProConnector;

class GetAssetsRequest extends SaloonRequest
{
    protected ?string $connector = VesselProConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct()
    {
    }

    public function defineEndpoint(): string
    {
        return '/Track/Asset/Map/';
    }
}
