<form action="{{ route('filament.session.store') }}" method="post" @class([
    'bg-white space-y-8 shadow border border-gray-300 rounded-2xl p-8',
    'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
])>
    <div class="w-full flex justify-center">
        <x-filament::brand />
    </div>

    <h2 class="font-bold tracking-tight text-center text-2xl">
        {{ __('tobira::login.heading') }}
    </h2>

    @if (session('status'))
    <x-tobira::alert color="success">
        {{ session('status') }}
    </x-tobira::alert>
    @endif

    {{ $this->form }}

    <x-filament::button type="submit" class="w-full">
        {{ __('tobira::login.buttons.submit.label') }}
    </x-filament::button>

    @csrf
</form>
