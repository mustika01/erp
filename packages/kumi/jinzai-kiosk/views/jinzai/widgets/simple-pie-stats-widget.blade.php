<x-filament::widget class="jinzai-stacked-bar-stats-widget">
    <x-filament::card class="h-[350px]">
        <div class="flex flex-col">
            <header class="mb-4">
                <h2 class="font-medium">{{ $this->getHeading() }}</h2>
            </header>

            <div class="flex items-center justify-center">
                <div class="flex items-center justify-center w-[11.5rem] h-[11.5rem] rounded-full" style="
                    background: conic-gradient({{ $this->getSlicesBackground() }})
                ">
                    <div class="flex items-center justify-center w-20 h-20 rounded-full bg-white dark:bg-gray-800">
                        <span class="text-gray-500 dark:text-gray-300">{{ $this->getTotal() }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-col mt-6 divide-y dark:divide-gray-700">
                @foreach ($this->getCachedSlices() as $slice)
                    {{ $slice->total($this->getTotal()) }}
                @endforeach
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
