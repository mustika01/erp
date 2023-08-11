<form
    x-data="{
        showingRecoveryForm: false,
    }"
    action="{{ route('filament.two-factor.create') }}" method="post" @class([
        'bg-white space-y-8 shadow border border-gray-300 rounded-2xl p-8',
        'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
])>
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <h2 class="font-bold tracking-tight text-center text-2xl">
        {{ __('tobira::two-factor-authentication/challenge.heading') }}
    </h2>

    <section>
        <div x-show="!showingRecoveryForm">
            <p class="text-sm text-gray-600 dark:text-white">
                {{ __('tobira::two-factor-authentication/challenge.messages.instruction-code') }}
            </p>

            <div class="mt-4">
                {{ $this->codeForm }}
            </div>
        </div>

        <div x-show="showingRecoveryForm">
            <p class="text-sm text-gray-600 dark:text-white">
                {{ __('tobira::two-factor-authentication/challenge.messages.instruction-recovery') }}
            </p>

            <div class="mt-4">
                {{ $this->recoveryForm }}
            </div>
        </div>

        <div class="flex justify-end mt-2">
            <button x-show="!showingRecoveryForm" type="button" class="text-sm" @click="showingRecoveryForm = true">
                {{ __('tobira::two-factor-authentication/challenge.buttons.recovery.label') }}
            </button>
            <button x-show="showingRecoveryForm" type="button" class="text-sm" @click="showingRecoveryForm = false">
                {{ __('tobira::two-factor-authentication/challenge.buttons.code.label') }}
            </button>
        </div>
    </section>

    <x-filament::button type="submit" class="w-full">
        {{ __('tobira::two-factor-authentication/challenge.buttons.submit.label') }}
    </x-filament::button>

    @csrf
</form>
