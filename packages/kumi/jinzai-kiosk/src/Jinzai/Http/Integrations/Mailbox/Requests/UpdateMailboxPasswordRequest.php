<?php

namespace Kumi\Jinzai\Http\Integrations\Mailbox\Requests;

use Sammyjo20\Saloon\Constants\Saloon;
use Sammyjo20\Saloon\Http\SaloonRequest;
use Sammyjo20\Saloon\Traits\Plugins\HasJsonBody;
use Kumi\Jinzai\Http\Integrations\Mailbox\MailboxConnector;

class UpdateMailboxPasswordRequest extends SaloonRequest
{
    use HasJsonBody;

    /**
     * The connector class.
     */
    protected ?string $connector = MailboxConnector::class;

    /**
     * The HTTP verb the request will use.
     */
    protected ?string $method = Saloon::PUT;

    public function __construct(protected string $username)
    {
    }

    /**
     * The endpoint of the request.
     */
    public function defineEndpoint(): string
    {
        return "/mailbox/{$this->username}/password";
    }
}
