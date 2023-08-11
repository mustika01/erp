<x-filament::page>
    <div class="md:w-32"></div>

    <form wire:submit.prevent="handle" class="space-y-6">
        <x-tobira::filament.forms.card>
            <div class="flex flex-col items-center md:flex-col md:items-start xl:flex-row xl:items-stretch space-y-6 xl:space-y-0 xl:space-x-6">
                <div class="bg-white p-4">
                    {!! $qr !!}
                </div>

                <div class="flex flex-col justify-between space-y-6 py-0 xl:py-4 dark:py-0">
                    <div class="prose prose-sm xl:prose-base dark:prose-invert">
                        <h4>{{ __('tobira::two-factor-authentication/qr-code.messages.instruction') }}</h4>

                        <ol>
                            <li>{{ __('tobira::two-factor-authentication/qr-code.steps.1') }}</li>
                            <li>{{ __('tobira::two-factor-authentication/qr-code.steps.2') }}</li>
                            <li>{{ __('tobira::two-factor-authentication/qr-code.steps.3') }}</li>
                        </ol>
                    </div>

                    {{ $this->form }}
                </div>
            </div>
        </x-tobira::filament.forms.card>

        <x-filament::button type="submit">
            {{ __('tobira::two-factor-authentication/qr-code.buttons.submit.label') }}
        </x-filament::button>
    </form>
</x-filament::page>
