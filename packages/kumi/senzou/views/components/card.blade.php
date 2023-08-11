<div
    {{ $attributes->merge([
        'class' =>
            'block max-w-sm rounded-lg border border-gray-200 bg-white p-6 shadow dark:border-gray-700 dark:bg-gray-800',
    ]) }}>
    {{ $slot }}
</div>
