@php
    $count = 1;
@endphp

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-inter">

    <main class="container mx-auto py-2" x-data="{ showBankDetails: false }">

        <header class="flex items-center justify-between">

            <div></div>

            <div class="flex flex-col items-center">
                <h4 class="text-lg font-medium">{{ $company }}</h4>
                <span class="text-sm">{{ $title }}</span>
            </div>

            <div>
                @if($hasViewReportBreakDownPermission)
                <label for="bank" class="flex items-center justify-center space-x-2">
                    <input type="checkbox" name="bank" x-model="showBankDetails">
                    <span>Show Bank Details</span>
                </label>
                @endif
            </div>

        </header>

        <section class="my-2">

            <table class="w-full border divide-y text-sm">
                <thead>
                    <tr class="divide-x text-sm">
                        @foreach ($columns as $column)
                            <th class="py-1 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($groupedPayouts as $department => $payouts)
                    @foreach ($payouts as $payout)
                    @if($hasViewReportBreakDownPermission)
                        <tr class="divide-x">
                            <td class="px-2 py-1 text-center w-12">
                                <div>
                                    {{ $count++ }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $payout->payroll->employee->user->name }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $payout->payroll->employee->job_position }}
                                </div>
                            </td>
                            <td class="px-2 py-1 text-right w-36">
                                <div class="font-mono">
                                    {{ $payout->base_amount_formatted }}
                                </div>
                            </td>
                            <td class="px-2 py-1 text-right w-32">
                                <div class="font-mono">
                                    {{ $payout->job_allowance_amount_formatted }}
                                </div>
                            </td>
                            <td class="px-2 py-1 text-right w-32">
                                <div class="font-mono">
                                    {{ $payout->loan_amount_formatted }}
                                </div>
                            </td>
                            <td class="px-2 py-1 text-right w-32">
                                <div class="font-mono">
                                    {{ $payout->adjustment_amount_formatted }}
                                </div>
                            </td>
                            <td class="px-2 py-1 text-right w-36">
                                <div class="font-mono">
                                    {{ $payout->take_home_pay_amount_formatted }}
                                </div>
                            </td>
                            <td class="px-2 py-1 text-right w-36">
                                <div class="space-x-0.5">
                                    @foreach ($payout->approvals->pluck('user_id') as $id)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $id }}
                                        </span>
                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr class="divide-x" x-show="showBankDetails">
                            <td></td>
                            <td class="px-2 py-1">
                                {{ $payout->payroll->primaryBank->account_holder_name ?? 'N/A' }}
                            </td>
                            <td class="px-2 py-1">
                                {{ $payout->payroll->primaryBank->bank_name ?? 'N/A' }}
                            </td>
                        </tr>
                    @endif
                    @endforeach
                    <tr class="bg-gray-100">
                        <td class="p-2 font-semibold" colspan="3">
                            <div class="text-base">
                                {{ $department }}
                            </div>
                        </td>
                        <td class="p-2 font-semibold text-right border-l">
                            <div class="text-base">
                                {{ number_format($payouts->sum('base_amount')) }}
                            </div>
                        </td>
                        <td class="p-2 font-semibold text-right border-l">
                            <div class="text-base">
                                {{ number_format($payouts->sum('job_allowance_amount')) }}
                            </div>
                        </td>
                        <td class="p-2 font-semibold text-right border-l">
                            <div class="text-base">
                                {{ number_format($payouts->sum('loan_amount')) }}
                            </div>
                        </td>
                        <td class="p-2 font-semibold text-right border-l">
                            <div class="text-base">
                                {{ number_format($payouts->sum('adjustment_amount')) }}
                            </div>
                        </td>
                        <td class="p-2 font-semibold text-right border-l border-r">
                            <div class="text-base">
                                {{ number_format($payouts->sum('take_home_pay_amount')) }}
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <th class="font-semibold text-base"></th>
                        <th class="font-semibold text-base"></th>
                        <th class="font-semibold text-base"></th>
                        <th class="font-semibold text-base px-2 py-1 text-right border-l">{{ $base_payout }}</th>
                        <th class="font-semibold text-base px-2 py-1 text-right border-l">{{ $job_allowance_payout }}</th>
                        <th class="font-semibold text-base px-2 py-1 text-right border-l">{{ $loan_payout }}</th>
                        <th class="font-semibold text-base px-2 py-1 text-right border-l">{{ $adjustment_payout }}</th>
                        <th class="font-semibold text-base px-2 py-1 text-right border-l border-r">{{ $take_home_pay_payout }}</th>
                        <th class="font-semibold text-base"></th>
                    </tr>
                </tfoot>
            </table>

        </section>

        @if ($approvals->isNotEmpty())
        <footer class="pt-2">

            <section class="flex flex-col space-y-1">
                <h4 class="text-sm font-medium">{{ __('kanri::reports/payout.headings.approval_codes') }}</h4>
                @foreach ($approvals as $key => $value)
                <div class="flex space-x-2">
                    <span class="inline-flex items-center px-1.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        {{ $key }}
                    </span>
                    <span class="text-sm">{{ $value }}</span>
                </div>
                @endforeach
            </section>

        </footer>
        @endif

    </main>

</body>

</html>
