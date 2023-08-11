@php
    $count = 1;
@endphp

@extends('senzou::layouts.master')

@section('title', __('senzou::filament/resources/request-note.sub_titles.view.label'))

@section('actions')
    <div>
        <span>{{ $request_note->created_at->format('d F Y') }}</span>
    </div>
@endsection

@section('content')
    <form action="{{ route('senzou.request-notes.show', $request_note->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="pb-8">
            <div
                class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-8">

                <div class="grid gap-6 md:grid-cols-4">
                    <div class="mb-6">
                        <label for="location" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.columns.location.label') }}
                        </label>
                        <input type="text" id="location"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="location" value="{{ old('location', $request_note->location) }}" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="voyage_number" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.columns.voyage_number.label') }}
                        </label>
                        <input type="text" id="voyage_number"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="voyage_number" value="{{ old('voyage_number', $request_note->voyage_number) }}" disabled>
                    </div>
                    <div class="mb-6">
                        <label for="remarks" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.columns.remarks.label') }}
                        </label>
                        <input type="text" id="remarks"
                            class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="remarks" value="{{ old('remarks', $request_note->remarks) }}" disabled>
                    </div>
                    <div>
                        <label for="delivery_requirement"
                            class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.columns.delivery_requirement.label') }}
                        </label>
                        <input type="text" id="delivery_requirement"
                            class="form-control @error('delivery_requirement') is-invalid @enderror block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                            name="delivery_requirement"
                            value="{{ old('delivery_requirement', $request_note->delivery_requirement) }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow dark:border-gray-700 dark:bg-gray-800 sm:p-8">
            <div class="mt-4 flex items-center">
                <div class="mr-6">
                    <label class="mb-0.5 block w-10 text-sm font-medium text-gray-900 dark:text-white">
                        {{ __('senzou::filament/resources/request-note.fields.number.label') }}
                    </label>
                </div>
                <div class="grid w-full gap-6 md:grid-cols-1">
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
                <div class="grid w-full gap-6 md:grid-cols-1">
                    <div>
                        <label for="reason" class="mb-0.5 block text-sm font-medium text-gray-900 dark:text-white">
                            {{ __('senzou::filament/resources/request-note.fields.reason.label') }}
                        </label>
                    </div>
                </div>
            </div>

            <!-- Table Item Request -->
            @foreach ($request_note->items as $item)
                <div class="mt-4 flex items-center">
                    <div class="mr-6">
                        <span>{{ $count++ }}.</span>
                    </div>
                    <div class="grid w-full gap-6 md:grid-cols-1">
                        <div>
                            <input type="text" id="item"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $item->id }}]" value="{{ old('name', $item->name) }}" disabled>
                        </div>
                    </div>
                    <div class="px-6">
                        <div>
                            <input type="number" id="quantity"
                                class="block w-16 w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $item->id }}]" value="{{ old('quantity', $item->quantity) }}" disabled>
                        </div>
                    </div>
                    <div class="pr-6">
                        <div>
                            <input type="number" id="stock_on_vessel"
                                class="block w-16 w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $item->id }}]"
                                value="{{ old('stock_on_vessel', $item->stock_on_vessel) }}" disabled>
                        </div>
                    </div>
                    <div class="grid w-full gap-6 md:grid-cols-1">
                        <div>
                            <input type="text" id="reason"
                                class="form-control block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                                name="items[{{ $item->id }}]" value="{{ old('reason', $item->reason) }}" disabled>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </form>
@endsection
