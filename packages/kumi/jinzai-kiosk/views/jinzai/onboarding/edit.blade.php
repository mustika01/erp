@extends('jinzai::layouts.base')

@section('title', __('jinzai::filament/resources/onboarding-link.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen filament-login-page">
    <div class="p-2 max-w-md space-y-8 w-screen">
        @livewire('jinzai::forms.onboarding', [$link])
    </div>
</div>

@endsection
