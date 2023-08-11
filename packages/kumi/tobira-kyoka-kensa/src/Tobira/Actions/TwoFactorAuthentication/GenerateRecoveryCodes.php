<?php

namespace Kumi\Tobira\Actions\TwoFactorAuthentication;

use Laravel\Fortify\RecoveryCode;
use Illuminate\Support\Collection;
use Lorisleiva\Actions\Concerns\AsAction;
use Kumi\Tobira\Support\SessionKey\TwoFactorAuthentication;

class GenerateRecoveryCodes
{
    use AsAction;

    public function handle(bool $encodeJSON = false): array|string
    {
        $encodedRecoveryCodes = session(TwoFactorAuthentication::RECOVERY_CODES);

        if (is_null($encodedRecoveryCodes)) {
            $recoveryCodes = $this->generateRecoveryCodes();

            $encodedRecoveryCodes = json_encode($recoveryCodes);

            session([TwoFactorAuthentication::RECOVERY_CODES => $encodedRecoveryCodes]);
        } else {
            $recoveryCodes = json_decode($encodedRecoveryCodes, true);
        }

        return $encodeJSON ? $encodedRecoveryCodes : $recoveryCodes;
    }

    protected function generateRecoveryCodes(): array
    {
        return Collection::times(8, function () {
            return RecoveryCode::generate();
        })->all();
    }
}
