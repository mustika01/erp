@extends('tobira::layouts.base')

@section('title', __('tobira::login.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen filament-login-page">
    <div class="p-2 max-w-md space-y-8 w-screen">
        @livewire('tobira::forms.login')

        @if (\Laravel\Fortify\Features::enabled(\Laravel\Fortify\Features::registration()))
        <div class="flex items-center justify-center space-x-2 text-sm filament-footer">
            <span>{{ __('tobira::login.links.account.label') }}</span>
            <a
                href="{{ route('filament.registration.create') }}"
                class="font-medium text-primary-600 hover:text-primary-500 transition"
            >
                {{ __('tobira::login.links.sign-up.label') }}
            </a>
        </div>
        @endif
    </div>
</div>

@endsection
