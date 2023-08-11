@extends('norikumi::layouts.base')

@section('title', __('norikumi::filament/forms/registration.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen">
    <div class="p-2 max-w-md space-y-8 w-screen">
        <div @class([
            'bg-white space-y-8 shadow border border-gray-300 rounded-2xl p-8',
            'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
        ])>
            <div class="w-full flex justify-center">
                <x-filament::brand />
            </div>

            <h2 class="font-bold tracking-tight text-center text-2xl">
                {{ __('norikumi::filament/forms/completion.heading') }}
            </h2>

            <p>
                {{ __('norikumi::filament/forms/completion.message') }}
            </p>

            <x-filament::button tag="a" href="{{ route('filament.auth.login') }}" class="w-full">
                {{ __('norikumi::filament/forms/completion.buttons.home.label') }}
            </x-filament::button>
        </div>
    </div>
</div>

@endsection
