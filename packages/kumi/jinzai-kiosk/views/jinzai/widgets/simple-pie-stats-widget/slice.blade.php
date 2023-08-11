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
        ]) style="background-color: {{ $getColor() }}"></div>
        <h4 class="font-medium">{{ $getLabel() }}</h4>
    </div>
    <div class="flex space-x-4 text-gray-500 dark:text-gray-300">
        <span>{{ $getValue() }}</span>
        <span class="w-10 text-right">{{ $getPercentageLabel() }}</span>
    </div>
</{!! $tag !!}>
