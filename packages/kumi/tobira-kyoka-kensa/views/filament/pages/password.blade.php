<x-filament::page>
    <form wire:submit.prevent="update" class="space-y-6">
        {{ $this->form }}

        <x-filament::button type="submit">
            {{ __('tobira::password.buttons.save.label') }}
        </x-filament::button>
    </form>
</x-filament::page>
