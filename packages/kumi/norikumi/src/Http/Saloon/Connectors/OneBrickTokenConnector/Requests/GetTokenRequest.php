<?php

namespace Kumi\Norikumi\Http\Saloon\Connectors\OneBrickTokenConnector\Requests;

use Kumi\Norikumi\Http\Saloon\Connectors\OneBrickTokenConnector;
use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\Auth\BasicAuthenticator;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Interfaces\AuthenticatorInterface;

class GetTokenRequest extends SaloonRequest
{
    protected ?string $connector = OneBrickTokenConnector::class;

    protected ?string $method = Saloon::GET;

    public function __construct()
    {
    }

    public function defineEndpoint(): string
    {
        return '/auth/token';
    }

    public function defaultAuth(): ?AuthenticatorInterface
    {
        $key = config('services.onebrick.key');
        $secret = config('services.onebrick.secret');

        return new BasicAuthenticator($key, $secret);
    }
}
