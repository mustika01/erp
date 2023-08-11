@php
    $color = match ($getContent()) {
        \Kumi\Kiosk\Support\Enums\TicketStatus::REJECTED => \Illuminate\Support\Arr::toCssClasses(['text-danger-700 bg-danger-500/10', 'dark:text-danger-500' => config('tables.dark_mode')]),
        \Kumi\Kiosk\Support\Enums\TicketStatus::RESOLVED => \Illuminate\Support\Arr::toCssClasses(['text-primary-700 bg-primary-500/10', 'dark:text-primary-500' => config('tables.dark_mode')]),
        \Kumi\Kiosk\Support\Enums\TicketStatus::APPROVED => \Illuminate\Support\Arr::toCssClasses(['text-success-700 bg-success-500/10', 'dark:text-success-500' => config('tables.dark_mode')]),
        \Kumi\Kiosk\Support\Enums\TicketStatus::PENDING => \Illuminate\Support\Arr::toCssClasses(['text-warning-700 bg-warning-500/10', 'dark:text-warning-500' => config('tables.dark_mode')]),
        \Kumi\Kiosk\Support\Enums\TicketStatus::UNDER_REVIEW => \Illuminate\Support\Arr::toCssClasses(['text-gray-700 bg-gray-500/10', 'dark:text-gray-300 dark:bg-gray-500/20' => config('tables.dark_mode')]),
    };
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :state-path="$getStatePath()"
>
    <div {{ $attributes->merge($getExtraAttributes())->class('filament-forms-placeholder-component') }}>


        <div @class([
            'inline-flex items-center justify-center space-x-1 rtl:space-x-reverse min-h-6 px-2 py-0.5 text-sm font-medium tracking-tight rounded-xl whitespace-normal',
            $color => $color,
        ])>
            <span>
                {{ __('kiosk::filament/resources/ticket.statuses.' . $getContent()) }}
            </span>
        </div>
    </div>
</x-dynamic-component>
