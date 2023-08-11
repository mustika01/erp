<?php

namespace Kumi\Jinzai\Validation\Rules;

use Illuminate\Contracts\Validation\DataAwareRule;
use Illuminate\Contracts\Validation\InvokableRule;
use Kumi\Jinzai\Http\Saloon\Connectors\OneBrickConnector\Requests\ValidateBankAccountRequest;

class ValidBankAccount implements DataAwareRule, InvokableRule
{
    /**
     * All of the data under validation.
     *
     * @var array
     */
    protected $data = [];

    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @param \Closure $fail
     */
    public function __invoke($attribute, $value, $fail)
    {
        $payload = $this->data['mountedTableActionData'];
        $accountNumber = $payload['account_number'];
        $bankShortCode = $payload['bank_name'];

        $request = new ValidateBankAccountRequest($accountNumber, $bankShortCode);
        $response = $request->send();
        $status = $response->status();

        if ($status >= 400) {
            $fail(__('jinzai::validation.unknown_error'));

            return;
        }

        $data = $response->json()['data'];

        if ($data['accountName'] === 'invalid') {
            $fail(__('jinzai::validation.invalid_account_name'));
        }
    }

    /**
     * Set the data under validation.
     *
     * @param array $data
     *
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }
}
