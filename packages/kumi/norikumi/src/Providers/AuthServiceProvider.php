<?php

namespace Kumi\Norikumi\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Kumi\Norikumi\Models\Address;
use Kumi\Norikumi\Models\Assignment;
use Kumi\Norikumi\Models\Bank;
use Kumi\Norikumi\Models\Crew;
use Kumi\Norikumi\Models\Document;
use Kumi\Norikumi\Models\Identity;
use Kumi\Norikumi\Models\Loan;
use Kumi\Norikumi\Models\Payout;
use Kumi\Norikumi\Models\Payroll;
use Kumi\Norikumi\Models\RegistrationFormEntry;
use Kumi\Norikumi\Models\Relative;
use Kumi\Norikumi\Policies\AddressPolicy;
use Kumi\Norikumi\Policies\AssignmentPolicy;
use Kumi\Norikumi\Policies\BankPolicy;
use Kumi\Norikumi\Policies\CrewPolicy;
use Kumi\Norikumi\Policies\DocumentPolicy;
use Kumi\Norikumi\Policies\IdentityPolicy;
use Kumi\Norikumi\Policies\LoanPolicy;
use Kumi\Norikumi\Policies\PayoutPolicy;
use Kumi\Norikumi\Policies\PayrollPolicy;
use Kumi\Norikumi\Policies\RegistrationFormEntryPolicy;
use Kumi\Norikumi\Policies\RelativePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Crew::class => CrewPolicy::class,
        Identity::class => IdentityPolicy::class,
        Document::class => DocumentPolicy::class,
        Address::class => AddressPolicy::class,
        Relative::class => RelativePolicy::class,
        Assignment::class => AssignmentPolicy::class,
        RegistrationFormEntry::class => RegistrationFormEntryPolicy::class,
        Payroll::class => PayrollPolicy::class,
        Payout::class => PayoutPolicy::class,
        Bank::class => BankPolicy::class,
        Loan::class => LoanPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
