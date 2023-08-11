@props([
    'color' => null,
    'label' => null,
    'tag' => 'div',
    'value' => null,
    'extraAttributes' => [],
])

<{!! $tag !!}
    @class(['flex flex-col'])
>
    <div {{ $attributes->merge($getExtraAttributes())->class([
        'flex h-4 w-full rounded',
        match($getColor()) {
            'primary' => \Illuminate\Support\Arr::toCssClasses(['bg-primary-300']),
            'danger' => \Illuminate\Support\Arr::toCssClasses(['bg-danger-300']),
            'success' => \Illuminate\Support\Arr::toCssClasses(['bg-success-300']),
            'warning' => \Illuminate\Support\Arr::toCssClasses(['bg-warning-300']),
            'red' => \Illuminate\Support\Arr::toCssClasses(['bg-red-300']),
            'orange' => \Illuminate\Support\Arr::toCssClasses(['bg-orange-300']),
            'yellow' => \Illuminate\Support\Arr::toCssClasses(['bg-yellow-300']),
            'green' => \Illuminate\Support\Arr::toCssClasses(['bg-green-300']),
            'cyan' => \Illuminate\Support\Arr::toCssClasses(['bg-cyan-300']),
            'blue' => \Illuminate\Support\Arr::toCssClasses(['bg-blue-300']),
            'purple' => \Illuminate\Support\Arr::toCssClasses(['bg-purple-300']),
            'pink' => \Illuminate\Support\Arr::toCssClasses(['bg-pink-300']),
            default => \Illuminate\Support\Arr::toCssClasses(['bg-gray-300', 'dark:bg-gray-700' => config('filament.dark_mode')]),
        }
    ]) }}
    >
        <div @class([
            'flex h-full w-full rounded',
            match($getColor()) {
                'primary' => \Illuminate\Support\Arr::toCssClasses(['bg-primary-500']),
                'danger' => \Illuminate\Support\Arr::toCssClasses(['bg-danger-500']),
                'success' => \Illuminate\Support\Arr::toCssClasses(['bg-success-500']),
                'warning' => \Illuminate\Support\Arr::toCssClasses(['bg-warning-500']),
                'red' => \Illuminate\Support\Arr::toCssClasses(['bg-red-500']),
                'orange' => \Illuminate\Support\Arr::toCssClasses(['bg-orange-500']),
                'yellow' => \Illuminate\Support\Arr::toCssClasses(['bg-yellow-500']),
                'green' => \Illuminate\Support\Arr::toCssClasses(['bg-green-500']),
                'cyan' => \Illuminate\Support\Arr::toCssClasses(['bg-cyan-500']),
                'blue' => \Illuminate\Support\Arr::toCssClasses(['bg-blue-500']),
                'purple' => \Illuminate\Support\Arr::toCssClasses(['bg-purple-500']),
                'pink' => \Illuminate\Support\Arr::toCssClasses(['bg-pink-500']),
                default => \Illuminate\Support\Arr::toCssClasses(['bg-gray-500', 'dark:bg-gray-700' => config('filament.dark_mode')]),
            }
        ]) style="width: {{ $getPercentageLabel() }};">
        </div>
    </div>
    <div class="flex justify-between mt-2">
        <h4 class="text-sm font-medium">{{ $getLabel() }}</h4>
        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $getValue() }}</span>
    </div>
</{!! $tag !!}>
