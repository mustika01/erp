@props([
    'columns' => [
        'lg' => 2,
    ],
])

<form wire:submit.prevent="submit" class="space-y-8">
    <div class="flex w-full gap-x-8">
        <div class="flex-1">
            {{ $this->form }}
        </div>

        <x-filament::button type="submit">
            <x-heroicon-o-search class="h-8 w-8" />
        </x-filament::button>
    </div>

    <x-filament-support::grid :default="$columns['default'] ?? 1" :sm="$columns['sm'] ?? null" :md="$columns['md'] ?? null" :lg="$columns['lg'] ?? ($columns ? (is_array($columns) ? null : $columns) : 2)" :xl="$columns['xl'] ?? null"
        :two-xl="$columns['2xl'] ?? null" class="filament-widgets-container mb-6 gap-4 lg:gap-8">
        @foreach ($destinationPortIds as $destinationPortId)
            @livewire(
                \Livewire\Livewire::getAlias($widgetClass),
                [
                    'destinationPortId' => $destinationPortId,
                    'started_at' => $started_at,
                    'ended_at' => $ended_at,
                    'voyage_status' => $voyage_status,
                ],
                key($widgetClass)
            )
        @endforeach
    </x-filament-support::grid>
</form>
