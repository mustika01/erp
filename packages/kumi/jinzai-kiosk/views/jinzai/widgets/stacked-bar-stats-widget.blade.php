<x-filament::widget class="jinzai-stacked-bar-stats-widget">
    <x-filament::card class="h-[350px]">
        <div class="flex flex-col">
            <header class="mb-4">
                <h2 class="font-medium">{{ $this->getHeading() }}</h2>
            </header>

            <div class="flex rounded">
                @foreach ($this->getCachedLineItems() as $item)
                    <div @class([
                        'block h-2 first:rounded-l last:rounded-r',
                        match($item->getColor()) {
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
                    ]) style="width: {{ $item->total($this->getTotal())->getPercentageLabel() }};"></div>
                @endforeach
            </div>

            <div class="flex justify-between mt-2">
                <span class="text-xs text-gray-500 dark:text-gray-400">0%</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">100%</span>
            </div>

            <div class="flex flex-col mt-6 divide-y dark:divide-gray-700">
                <div class="flex justify-between text-sm py-2">
                    <h4 class="font-medium">
                        {{ __('jinzai::filament/widgets/employment-status.labels.total') }}
                    </h4>
                    <span class="text-gray-500 dark:text-gray-300">{{ $this->getTotal() }}</span>
                </div>

                @foreach ($this->getCachedLineItems() as $item)
                    {{ $item->total($this->getTotal()) }}
                @endforeach
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
