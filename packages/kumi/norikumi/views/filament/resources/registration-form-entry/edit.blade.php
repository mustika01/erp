@extends('norikumi::layouts.base')

@section('title', __('norikumi::filament/forms/registration.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen">
    <div class="p-2 max-w-3xl space-y-8 w-screen">
        @livewire('norikumi::forms.registration', ['entry' => $entry])
    </div>
</div>

@endsection
