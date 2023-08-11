<?php

namespace Kumi\Tobira\Tests\Validation\Rules;

use Kumi\Kensa\TestCase;
use Kumi\Tobira\Validation\Rules\OTPCode;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

/**
 * @internal
 */
class OTPCodeTest extends TestCase
{
    /** @test */
    public function it_can_verify_otp(): void
    {
        $this->mock(TwoFactorAuthenticationProvider::class)
            ->shouldReceive([
                'generateSecretKey' => 'THISIS4THESECRET',
                'verify' => true,
            ])
        ;

        $rule = $this->app->make(OTPCode::class);

        $this->assertTrue($rule->passes('code', '123456'));
    }

    /** @test */
    public function it_can_use_default_message(): void
    {
        $rule = $this->app->make(OTPCode::class);

        $this->assertEquals(__('tobira::two-factor-authentication/qr-code.validations.otp'), $rule->message());
    }

    /** @test */
    public function it_can_use_custom_message(): void
    {
        $rule = $this->app->make(OTPCode::class)
            ->withMessage('custom message')
        ;

        $this->assertEquals('custom message', $rule->message());
    }
}
