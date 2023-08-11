<x-filament::widget class="jinzai-progress-bar-stats-widget">
    <x-filament::card class="h-[350px] relative">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col">
                <header class="mb-4">
                    <h2 class="font-medium">{{ $this->getHeading() }}</h2>
                </header>

                <div class="flex flex-col rounded space-y-4">
                    @foreach ($this->getCachedLineItems() as $item)
                        {{ $item->total($this->getTotal()) }}
                    @endforeach
                </div>
            </div>
        </div>

        <div class="absolute px-6 pb-5 bottom-0 inset-x-0 flex items-center justify-between">
            <h4 class="text-sm font-medium">
                {{ __('jinzai::filament/widgets/employee-progress.labels.total_employees') }}
            </h4>
            <span class="text-sm text-gray-500 dark:text-gray-400">
                {{ $this->getTotal() }}
            </span>
        </div>
    </x-filament::card>
</x-filament::widget>
