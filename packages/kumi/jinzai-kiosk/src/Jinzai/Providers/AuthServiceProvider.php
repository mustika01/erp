<?php

namespace Kumi\Jinzai\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Kumi\Jinzai\Models\Bank;
use Kumi\Jinzai\Models\Department;
use Kumi\Jinzai\Models\Employment;
use Kumi\Jinzai\Models\Identity;
use Kumi\Jinzai\Models\JobPosition;
use Kumi\Jinzai\Models\Loan;
use Kumi\Jinzai\Models\Payout;
use Kumi\Jinzai\Models\Payroll;
use Kumi\Jinzai\Models\Relative;
use Kumi\Jinzai\Policies\BankPolicy;
use Kumi\Jinzai\Policies\ContractPolicy;
use Kumi\Jinzai\Policies\DepartmentPolicy;
use Kumi\Jinzai\Policies\EmployeePolicy;
use Kumi\Jinzai\Policies\EmploymentPolicy;
use Kumi\Jinzai\Policies\IdentityPolicy;
use Kumi\Jinzai\Policies\JobPositionPolicy;
use Kumi\Jinzai\Policies\LoanPolicy;
use Kumi\Jinzai\Policies\PayoutItemPolicy;
use Kumi\Jinzai\Policies\PayoutPolicy;
use Kumi\Jinzai\Policies\PayrollPolicy;
use Kumi\Jinzai\Policies\RelativePolicy;
use Kumi\Kyoka\Models\Employee;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Employee::class => EmployeePolicy::class,
        Identity::class => IdentityPolicy::class,
        Relative::class => RelativePolicy::class,
        Department::class => DepartmentPolicy::class,
        JobPosition::class => JobPositionPolicy::class,
        Employment::class => EmploymentPolicy::class,
        Payroll::class => PayrollPolicy::class,
        Bank::class => BankPolicy::class,
        Payout::class => PayoutPolicy::class,
        PayoutItem::class => PayoutItemPolicy::class,
        Loan::class => LoanPolicy::class,
        Employment::class => ContractPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
