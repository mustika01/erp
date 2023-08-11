@props([
    'color' => null,
    'label' => null,
    'tag' => 'div',
    'value' => null,
    'extraAttributes' => [],
])

<{!! $tag !!}
    {{ $attributes->merge($getExtraAttributes())->class([
        'flex justify-between text-sm py-2',
    ]) }}
>
    <div class="flex items-center space-x-2">
        <div @class([
            'block h-4 w-4 rounded',
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
        ])></div>
        <h4 class="font-medium">{{ $getLabel() }}</h4>
    </div>
    <div class="flex space-x-4 text-gray-500 dark:text-gray-300">
        <span>{{ $getValue() }}</span>
        <span class="w-10 text-right">{{ $getPercentageLabel() }}</span>
    </div>
</{!! $tag !!}>
