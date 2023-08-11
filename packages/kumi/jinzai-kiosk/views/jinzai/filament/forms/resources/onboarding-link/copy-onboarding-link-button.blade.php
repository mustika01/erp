<div class="flex items-end h-full" x-data="{
    showCopyLabel: true,
}">
    <x-filament-support::button class="w-full h-[42px]" color="secondary" x-clipboard.raw="{{ $getRecord()->getEditUrl() }}" @click="showCopyLabel = false">
        <span x-show="showCopyLabel">
            {{ __('jinzai::filament/resources/onboarding-link.buttons.copy.label') }}
        </span>
        <span x-show="!showCopyLabel" x-cloak>
            {{ __('jinzai::filament/resources/onboarding-link.buttons.copied.label') }}
        </span>
    </x-filament-support::button>
</div>
