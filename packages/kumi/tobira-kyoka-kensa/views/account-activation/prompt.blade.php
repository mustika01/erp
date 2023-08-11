@extends('tobira::layouts.base')

@section('title', __('tobira::login.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen filament-login-page">
    <div class="p-2 max-w-md space-y-8 w-screen">
        <div @class([
            'bg-white space-y-8 shadow border border-gray-300 rounded-2xl p-8',
            'dark:bg-gray-800 dark:border-gray-700' => config('filament.dark_mode'),
        ])>
            <div class="w-full flex justify-center">
                <x-filament::brand />
            </div>

            <h2 class="font-bold tracking-tight text-center text-2xl">
                {{ __('tobira::account-activation.heading') }}
            </h2>

            @if (session('status'))
            <x-tobira::alert color="success">
                {{ __('tobira::account-activation.' .session('status')) }}
            </x-tobira::alert>
            @endif

            <p class="text-sm text-gray-600 dark:text-white">
                {{ __('tobira::account-activation.messages.prompt') }}
            </p>
        </div>

        <div class="flex items-center justify-center space-x-2 text-sm filament-footer">
            <span>{{ __('tobira::account-activation.links.cancel.label') }}</span>
            <form action="{{ route('filament.session.destroy') }}" method="post">
                <button
                    type="submit"
                    class="font-medium text-primary-600 hover:text-primary-500 transition"
                >
                    {{ __('tobira::account-activation.links.log-out.label') }}
                </button>

                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>

@endsection
