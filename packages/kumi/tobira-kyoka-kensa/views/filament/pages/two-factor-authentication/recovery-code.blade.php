<x-filament::page>
    <form wire:submit.prevent="handle" class="space-y-6">
        <x-tobira::filament.forms.card>
            <div class="prose dark:prose-invert">
                <p>{{ __('tobira::two-factor-authentication/recovery-code.messages.instruction') }}</p>

                <span class="font-bold">{{ __('tobira::two-factor-authentication/recovery-code.messages.warning') }}</span>
            </div>

            <ul class="bg-gray-50 dark:bg-gray-900 inline-flex flex-col border rounded font-mono p-4 mt-2">
                @foreach ($codes as $code)
                <li>{{ $code }}</li>
                @endforeach
            </ul>
        </x-tobira::filament.forms.card>

        <x-filament::button type="submit">
            {{ __('tobira::two-factor-authentication/recovery-code.buttons.submit.label') }}
        </x-filament::button>
    </form>
</x-filament::page>
