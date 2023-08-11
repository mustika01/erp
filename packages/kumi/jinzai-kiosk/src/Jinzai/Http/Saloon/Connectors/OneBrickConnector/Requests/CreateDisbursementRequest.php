<?php

namespace Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector;

class CreateDisbursementRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $connector = OneBrickConnector::class;

    protected ?string $method = Saloon::POST;

    public function __construct(
        protected array $data
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/payments/disbursements';
    }

    public function defaultData(): array
    {
        return $this->data;
    }
}
