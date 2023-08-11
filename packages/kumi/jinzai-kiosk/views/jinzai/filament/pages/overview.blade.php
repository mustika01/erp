<x-filament::page class="filament-dashboard-page">
    <div @class(['grid grid-cols-1 gap-4 lg:grid-cols-2 xl:grid-cols-3 lg:gap-8 mb-6 filament-widgets-container'])>
        @foreach ($this->getWidgets() as $widget)
            @if ($widget::canView())
                @livewire(\Livewire\Livewire::getAlias($widget))
            @endif
        @endforeach
    </div>
</x-filament::page>
