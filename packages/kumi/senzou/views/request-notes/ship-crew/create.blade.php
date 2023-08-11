@php
    $times = 20;
    $count = 1;
@endphp

@extends('senzou::layouts.master')

@section('title', __('senzou::filament/resources/request-note.sub_titles.create.label'))

@section('actions')
    <div>
        <span>{{ now()->format('d F Y') }}</span>
    </div>
@endsection

@section('content')
    <form method="POST" action="{{ route('senzou.request-notes.store') }}">
        @csrf
        <div class="pb-8">
            <div
                class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-8">
                <div class="grid gap-6 md:grid-cols-4">

                    <div>
                        <label for="location" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.location.label') }}
                        </label>
                        <input type="text" id="location"
                            class="form-control @error('location') is-invalid @enderror block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="location" value="{{ old('location') }}" required>
                        @error('location')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="voyage_number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.voyage_number.label') }}
                        </label>
                        <input type="text" id="voyage_number"
                            class="form-control @error('location') is-invalid @enderror block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="voyage_number" value="{{ old('voyage_number') }}" required>
                        @error('voyage_number')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="delivery_requirement"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.delivery_requirement.label') }}
                        </label>
                        <select id="delivery_requirement"
                            class="form-control @error('delivery_requirement') is-invalid @enderror block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="delivery_requirement" required>
                            @foreach ($delivery_requirements as $delivery_requirement)
                                <option value="{{ $delivery_requirement }}" @selected(old('delivery_requirement', $default_delivery_requirement) == $delivery_requirement)>
                                    {{ $delivery_requirement }}
                                </option>
                            @endforeach
                        </select>
                        @error('delivery_requirement')
                            <div class="alert alert-danger mt-2">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div>
                        <label for="remarks" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.remarks.label') }}
                        </label>
                        <input type="text" id="item"
                            class="form-control block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="remarks" value="{{ $remarks }}" readonly>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full rounded-lg border border-gray-200 bg-white p-8 shadow dark:border-gray-700 dark:bg-gray-800">
            <div class="flex items-center">
                <div class="mr-6">
                    <label class="mb-0.5 block w-10 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('senzou::filament/resources/request-note.fields.number.label') }}
                    </label>
                </div>
                <div class="w-full">
                    <div>
                        <label for="item" class="mb-0.5 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.item.label') }}
                        </label>
                    </div>
                </div>
                <div class="px-6">
                    <div>
                        <label for="quantity" class="mb-0.5 block w-16 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.quantity.label') }}
                        </label>
                    </div>
                </div>
                <div class="pr-6">
                    <div>
                        <label for="stock_on_vessel"
                            class="mb-0.5 block w-16 text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.stock_on_vessel.label') }}
                        </label>
                    </div>
                </div>
                <div class="w-full">
                    <div>
                        <label for="reason" class="mb-0.5 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.reason.label') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <!-- Table Item Request -->
                @for ($i = 1; $i <= $times; $i++)
                    <div class="flex items-center space-x-6">
                        <div class="w-8">
                            <span>{{ $count++ }}.</span>
                        </div>
                        <div class="w-full">
                            <input type="text" id="item"
                                class="form-control block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $i }}][name]" value="{{ old('name') }}">
                        </div>
                        <div>
                            <input type="number" id="quantity"
                                class="form-control block w-16 w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $i }}][quantity]" value="{{ old('quantity', 0) }}">
                        </div>
                        <div>
                            <input type="number" id="stock_on_vessel"
                                class="form-control block w-16 w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $i }}][stock_on_vessel]"
                                value="{{ old('stock_on_vessel', 0) }}">
                        </div>
                        <div class="w-full">
                            <input type="text" id="reason"
                                class="form-control block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $i }}][reason]" value="{{ old('reason') }}">
                        </div>
                    </div>
                @endfor
            </div>

            <div class="mt-4">
                <button type="submit"
                    class="mr-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    {{ __('senzou::filament/resources/request-note.buttons.submit.label') }}
                </button>
            </div>
        </div>
    </form>
@endsection
