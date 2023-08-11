<?php

namespace Kumi\Jinzai\Filament\Resources\PayoutResource\Widgets;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Kumi\Jinzai\Models\Payout;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class PayoutOverviewWidget extends StatsOverviewWidget
{
    public string $totalBasePayout;
    public string $totalJobAllowancePayout;
    public string $totalLoanPayout;
    public string $totalAdjustmentPayout;
    public string $totalTakeHomePayPayout;
    public string $totalEmployeePayout;

    protected static ?string $pollingInterval = null;

    protected int|string|array $columnSpan = 3;

    protected $listeners = ['filterPeriod' => 'updateStats'];

    public function mount(Request $request)
    {
        $data = $request->get('tableFilters')['period'] ?? [];

        $this->updateStats([
            'year' => $data['year'] ?? Carbon::now()->format('Y'),
            'month' => $data['month'] ?? Carbon::now()->format('F'),
        ]);
    }

    public function updateStats(array $data): void
    {
        $date = Carbon::parse($data['year'] . ' ' . $data['month']);

        $payouts = Payout::query()->dateBetween(
            $date->copy()->startOfMonth()->startOfDay(),
            $date->copy()->endOfMonth()->endOfDay(),
        )->get();

        $this->totalBasePayout = number_format($payouts->sum('base_amount'));
        $this->totalJobAllowancePayout = number_format($payouts->sum('job_allowance_amount'));
        $this->totalLoanPayout = number_format($payouts->sum('loan_amount'));
        $this->totalAdjustmentPayout = number_format($payouts->sum('adjustment_amount'));
        $this->totalTakeHomePayPayout = number_format($payouts->sum('take_home_pay_amount'));
        $this->totalEmployeePayout = $payouts->count();
    }

    protected function getCards(): array
    {
        return [
            Card::make(__('jinzai::filament/widgets/payout-overview-widget.total_base.label'), $this->totalBasePayout),
            Card::make(__('jinzai::filament/widgets/payout-overview-widget.total_loan.label'), $this->totalLoanPayout),
            Card::make(__('jinzai::filament/widgets/payout-overview-widget.total_take_home_pay.label'), $this->totalTakeHomePayPayout),
            Card::make(__('jinzai::filament/widgets/payout-overview-widget.total_job_allowance.label'), $this->totalJobAllowancePayout),
            Card::make(__('jinzai::filament/widgets/payout-overview-widget.total_adjustment.label'), $this->totalAdjustmentPayout),
            Card::make(__('jinzai::filament/widgets/payout-overview-widget.total_employee.label'), $this->totalEmployeePayout),
        ];
    }
}
