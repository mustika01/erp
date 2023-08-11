<x-filament::page x-data="{
    isShowingRecoveryCodes: $wire.entangle('isShowingRecoveryCodes'),
}">
    <x-tobira::filament.forms.card>
        <div class="prose dark:prose-invert">
            <p>{{ __('tobira::two-factor-authentication/status.messages.reminder') }}</p>

            <p x-show="isShowingRecoveryCodes">{{ __('tobira::two-factor-authentication/status.messages.instruction') }}</p>
        </div>

        <ul x-show="isShowingRecoveryCodes" class="bg-gray-50 dark:bg-gray-900 inline-flex flex-col border rounded font-mono p-4 mt-2">
            @foreach ($codes as $code)
            <li>{{ $code }}</li>
            @endforeach
        </ul>
    </x-tobira::filament.forms.card>

    <section class="flex space-x-4">
        <x-filament::button type="button" color="danger" wire:click="disable">
            {{ __('tobira::two-factor-authentication/status.buttons.disable.label') }}
        </x-filament::button>
        <x-filament::button x-show="!isShowingRecoveryCodes" type="button" color="secondary" @click="isShowingRecoveryCodes = true">
            {{ __('tobira::two-factor-authentication/status.buttons.show.label') }}
        </x-filament::button>
        <x-filament::button x-show="isShowingRecoveryCodes" type="button" color="secondary" wire:click="generate">
            {{ __('tobira::two-factor-authentication/status.buttons.generate.label') }}
        </x-filament::button>
    </section>
</x-filament::page>
