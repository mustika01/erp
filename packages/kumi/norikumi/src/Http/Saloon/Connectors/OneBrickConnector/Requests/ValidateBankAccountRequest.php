<?php

namespace Kumi\Norikumi\Http\Saloon\Connectors\OneBrickConnector\Requests;

use Kumi\Norikumi\Http\Saloon\Connectors\OneBrickConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;

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
