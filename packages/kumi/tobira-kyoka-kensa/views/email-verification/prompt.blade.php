@extends('tobira::layouts.base')

@section('title', __('tobira::login.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen filament-login-page">
    <div class="p-2 max-w-md space-y-8 w-screen">
        <form action="{{ route('filament.email-verification.send') }}" method="post" @class([
            'bg-white space-y-8 shadow border border-gray-300 rounded-2xl p-8',
            'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
        ])>
            <div class="w-full flex justify-center">
                <x-filament::brand />
            </div>

            <h2 class="font-bold tracking-tight text-center text-2xl">
                {{ __('tobira::email-verification.heading') }}
            </h2>

            @if (session('status'))
            <x-tobira::alert color="success">
                {{ __('tobira::email-verification.' .session('status')) }}
            </x-tobira::alert>
            @endif

            <p class="text-sm text-gray-600 dark:text-white">
                {{ __('tobira::email-verification.messages.prompt') }}
            </p>

            <x-filament::button type="submit" form="submit" class="w-full">
                {{ __('tobira::email-verification.buttons.submit.label') }}
            </x-filament::button>

            @csrf
        </form>

        <div class="flex items-center justify-center space-x-2 text-sm filament-footer">
            <span>{{ __('tobira::email-verification.links.cancel.label') }}</span>
            <form action="{{ route('filament.session.destroy') }}" method="post">
                <button
                    type="submit"
                    class="font-medium text-primary-600 hover:text-primary-500 transition"
                >
                    {{ __('tobira::email-verification.links.log-out.label') }}
                </button>

                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>

@endsection
