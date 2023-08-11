<form action="{{ route('filament.confirm-password.store') }}" method="post" @class([
    'bg-white space-y-8 shadow border border-gray-300 rounded-2xl p-8',
    'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
])>
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <h2 class="font-bold tracking-tight text-center text-2xl">
        {{ __('tobira::confirm-password.heading') }}
    </h2>

    @if (session('status'))
    <x-tobira::alert color="success">
        {{ session('status') }}
    </x-tobira::alert>
    @endif

    <p class="text-sm text-gray-600 dark:text-white">
        {{ __('tobira::confirm-password.messages.warning') }}
    </p>

    {{ $this->form }}

    <x-filament::button type="submit" class="w-full">
        {{ __('tobira::confirm-password.buttons.submit.label') }}
    </x-filament::button>

    @csrf
</form>
