<?php

namespace Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector;

class ValidateBankAccountRequest extends SaloonRequest
{
    use HasJsonBody;

    protected ?string $connector = OneBrickConnector::class;

    protected ?string $method = Saloon::POST;

    public function __construct(
        protected string $accountNumber,
        protected string $bankShortCode,
    ) {
    }

    public function defineEndpoint(): string
    {
        return '/payments/bank-account-validation';
    }

    public function defaultData(): array
    {
        return [
            'accountNumber' => $this->accountNumber,
            'bankShortCode' => $this->bankShortCode,
        ];
    }
}
