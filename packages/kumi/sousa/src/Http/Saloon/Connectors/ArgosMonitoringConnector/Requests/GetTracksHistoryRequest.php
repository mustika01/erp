<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\ArgosMonitoringConnector\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Kumi\Sousa\Http\Saloon\Connectors\ArgosMonitoringConnector;

class GetTracksHistoryRequest extends SaloonRequest
{
    protected ?string $connector = ArgosMonitoringConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct(
        public int $assetId,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/get.php';
    }

    public function defaultQuery(): array
    {
        return [
            'type' => 1,
            'd' => 14,
            'vessel' => $this->assetId,
        ];
    }
}
