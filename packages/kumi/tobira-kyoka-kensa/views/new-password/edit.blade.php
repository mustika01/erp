@extends('tobira::layouts.base')

@section('title', __('tobira::reset-password.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen filament-login-page">
    <div class="p-2 max-w-md space-y-8 w-screen">
        @livewire('tobira::forms.reset-password', ['token' => $request->route('token')])

        <div class="flex items-center justify-center space-x-2 text-sm filament-footer">
            <span>{{ __('tobira::reset-password.links.cancel.label') }}</span>
            <a
                href="{{ route('filament.session.create') }}"
                class="text-primary-600 hover:text-primary-500 transition"
            >
                {{ __('tobira::reset-password.links.log-in.label') }}
            </a>
        </div>
    </div>
</div>

@endsection
