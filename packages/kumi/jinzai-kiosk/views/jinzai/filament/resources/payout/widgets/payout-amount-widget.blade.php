<x-filament::widget class="filament-payout-amount-widget border border-gray-300 shadow-sm bg-white rounded-xl filament-tables-container dark:bg-gray-800 dark:border-gray-700 dark:divide-gray-700 divide-y">
    <div class="grid grid-cols-2 divide-x dark:divide-gray-700 col-start-2">
        <h4 class="px-4 py-3 font-medium">
            {{ __('jinzai::filament/resources/payout.headings.gross_payout') }}
        </h4>
        <span class="px-4 py-3 font-mono text-right">{{ $record->gross_payout_amount_formatted }}</span>
    </div>
    <div class="grid grid-cols-2 divide-x dark:divide-gray-700 col-start-2">
        <h4 class="px-4 py-3 font-medium">
            {{ __('jinzai::filament/resources/payout.headings.take_home_pay') }}
        </h4>
        <span class="px-4 py-3 font-mono text-right">{{ $record->take_home_pay_amount_formatted }}</span>
    </div>
</x-filament::widget>
