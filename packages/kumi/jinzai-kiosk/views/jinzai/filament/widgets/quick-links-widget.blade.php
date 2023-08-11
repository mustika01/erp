<x-filament::widget class="jinzai-progress-bar-stats-widget">
    <x-filament::card class="relative">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col">
                <header class="mb-4">
                    <h2 class="font-medium">{{ $this->getHeading() }}</h2>
                </header>

                <ul class="flex flex-wrap gap-4">
                    @foreach ($this->getLinks() as $link)
                        <li>
                            <x-filament::button tag="a" href="{{ $link['url'] }}" color="secondary">
                                {{ $link['label'] }}
                            </x-filament::button>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
