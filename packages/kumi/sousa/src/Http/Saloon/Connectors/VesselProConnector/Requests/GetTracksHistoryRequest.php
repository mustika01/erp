<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\VesselProConnector\Requests;

use Illuminate\Support\Carbon;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Kumi\Sousa\Http\Saloon\Connectors\VesselProConnector;

class GetTracksHistoryRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $connector = VesselProConnector::class;

    protected ?string $method = Saloon::POST;

    public function __construct(
        public int $assetId
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/Track/Asset/History/' . $this->assetId;
    }

    public function defaultData(): array
    {
        return [
            'start' => Carbon::now()->subDays(14)->startOfDay()->format('Y-m-d H:i'),
            'end' => Carbon::now()->endOfDay()->format('Y-m-d H:i'),
        ];
    }
}
