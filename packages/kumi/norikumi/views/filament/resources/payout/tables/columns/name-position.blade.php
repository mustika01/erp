<div class="px-4 py-3 filament-tables-text-column flex flex-col">
    <span>
        {{ $getRecord()->payroll->crew->name }}
    </span>
    <span class="text-xs text-gray-500 dark:text-gray-400">
        {{ $getRecord()->payroll->crew->position; }}
    </span>
</div>
