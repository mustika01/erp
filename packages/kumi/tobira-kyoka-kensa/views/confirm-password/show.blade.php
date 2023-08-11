@extends('tobira::layouts.base')

@section('title', __('tobira::confirm-password.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen filament-login-page">
    <div class="p-2 max-w-md space-y-8 w-screen">
        @livewire('tobira::forms.confirm-password')

        <div class="flex items-center justify-center space-x-2 text-sm filament-footer">
            <span>{{ __('tobira::confirm-password.links.cancel.label') }}</span>
            <form action="{{ route('filament.session.destroy') }}" method="post">
                <button
                    type="submit"
                    class="font-medium text-primary-600 hover:text-primary-500 transition"
                >
                    {{ __('tobira::confirm-password.links.log-out.label') }}
                </button>

                @csrf
                @method('delete')
            </form>
        </div>
    </div>
</div>

@endsection
