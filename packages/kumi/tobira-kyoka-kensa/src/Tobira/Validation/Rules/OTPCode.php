<?php

namespace Kumi\Tobira\Validation\Rules;

use Illuminate\Contracts\Validation\Rule;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;
use Kumi\Tobira\Actions\TwoFactorAuthentication\GenerateSecret;

class OTPCode implements Rule
{
    /**
     * The 2FA provider that is responsible for validating OTP Code.
     */
    protected TwoFactorAuthenticationProvider $provider;

    /**
     * The message that should be used when validation fails.
     */
    protected string $message;

    /**
     * Create a new rule instance.
     */
    public function __construct(TwoFactorAuthenticationProvider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $secret = GenerateSecret::run();

        return $value && $this->provider->verify($secret, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        if (isset($this->message)) {
            return $this->message;
        }

        return __('tobira::two-factor-authentication/qr-code.validations.otp');
    }

    /**
     * Set the message that should be used when the rule fails.
     *
     * @return $this
     */
    public function withMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }
}
