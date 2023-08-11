<div @class([
    'bg-white/50 backdrop-blur-xl shadow-2xl rounded-2xl relative',
    'dark:bg-gray-900/50 dark:border-gray-700' => config('filament.dark_mode'),
])>
    @if ($this->hasLatestTrack())
    <img src="{{ $this->getStaticMapUrl() }}" alt="{{ $vessel->name }}" style="height: 186px;" class="object-cover w-full rounded-2xl">
    @else
    <div class="flex w-full h-full items-center justify-center">
        <span class="italic text-gray-500">
            {{ __('sousa::filament/widgets/vessel-location.messages.tracking-unavailable') }}
        </span>
    </div>
    @endif
</div>
