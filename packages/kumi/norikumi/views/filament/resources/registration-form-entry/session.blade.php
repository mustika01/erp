@extends('norikumi::layouts.base')

@section('title', __('norikumi::filament/forms/pin-code.title'))

@section('content')

<div class="flex items-center justify-center min-h-screen">
    <div class="p-2 max-w-md space-y-8 w-screen">
        @livewire('norikumi::forms.pin-code', ['entry' => $entry])
    </div>
</div>

@endsection
