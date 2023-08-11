@extends('tobira::layouts.base')

@section('title', __('tobira::two-factor-authentication/challenge.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen filament-login-page">
    <div class="p-2 max-w-md space-y-8 w-screen">
        @livewire('tobira::forms.two-factor-challenge')

        <div class="flex items-center justify-center space-x-2 text-sm filament-footer">
            <span>{{ __('tobira::two-factor-authentication/challenge.links.cancel.label') }}</span>
            <a
                href="{{ route('filament.session.create') }}"
                class="font-medium text-primary-600 hover:text-primary-500 transition"
            >
                {{ __('tobira::two-factor-authentication/challenge.links.log-in.label') }}
            </a>
        </div>
    </div>
</div>

@endsection
