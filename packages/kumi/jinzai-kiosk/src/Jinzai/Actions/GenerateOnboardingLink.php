<?php

namespace Kumi\Jinzai\Actions;

use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Models\Employee;
use Kumi\Jinzai\Models\OnboardingLink;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateOnboardingLink
{
    use AsAction;

    protected static $tokenLength = 32;

    public function handle(Employee $employee): void
    {
        $onboardingLink = $employee->onboardingLink;

        if (is_null($onboardingLink)) {
            $onboardingLink = new OnboardingLink([
                'token' => Str::random(self::$tokenLength),
                'expired_at' => Carbon::now()->addMonth(),
            ]);

            $employee->onboardingLink()->save($onboardingLink);

            activity()
                ->performedOn($employee)
                ->log(__('jinzai::filament/resources/onboarding-link.events.created'))
            ;
        }
    }
}
