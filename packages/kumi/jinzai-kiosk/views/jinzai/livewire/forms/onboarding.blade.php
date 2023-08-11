<form action="{{ route('filament.onboarding.update', [$link]) }}" method="post" @class([
    'bg-white space-y-8 shadow border border-gray-300 rounded-2xl p-8',
    'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
])>
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <h2 class="font-bold tracking-tight text-center text-2xl">
        {{ __('jinzai::filament/resources/onboarding-link.heading') }}
    </h2>

    {{ $this->form }}

    <x-filament::button type="submit" class="w-full">
        {{ __('jinzai::filament/resources/onboarding-link.buttons.submit.label') }}
    </x-filament::button>

    @csrf
    @method('put')
</form>
