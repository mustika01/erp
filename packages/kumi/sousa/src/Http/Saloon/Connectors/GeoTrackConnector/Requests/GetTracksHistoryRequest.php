<?php

namespace Kumi\Sousa\Http\Saloon\Connectors\GeoTrackConnector\Requests;

use Illuminate\Support\Carbon;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasFormParams;
use Kumi\Sousa\Http\Saloon\Connectors\GeoTrackConnector;

class GetTracksHistoryRequest extends SaloonRequest
{
    use HasFormParams;

    protected ?string $connector = GeoTrackConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct(
        public int $assetId,
        public Carbon $date,
    ) {
    }

    public function defineEndpoint(): string
    {
        return "/users/{$this->assetId}/tracks";
    }

    public function defaultData(): array
    {
        return [
            'Date' => $this->date->format('Y-m-d'),
        ];
    }
}
