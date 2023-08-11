@extends('senzou::layouts.master')

@section('title', __('senzou::filament/resources/request-note.sub_titles.dashboard.label'))

@section('actions')
    @unless(Auth::user()->isNahkoda())
        <a href="{{ route('senzou.request-notes.create') }}"
            class="mr-2 rounded-lg bg-blue-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            {{ __('senzou::filament/resources/request-note.buttons.add.label') }}
        </a>
    @endunless
@endsection

@section('content')
    @if ($notes->isEmpty())
        <div class="flex rounded-lg border border-red-300 bg-red-50 p-4 text-sm text-red-800 dark:border-red-800 dark:bg-gray-800 dark:text-red-400"
            role="alert">
            <svg aria-hidden="true" class="mr-3 inline h-5 w-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <span class="font-medium">
                    {{ __('senzou::filament/resources/request-note.announced.empty.label') }}
                </span>
            </div>
        </div>
    @else
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            {{ __('senzou::filament/resources/request-note.columns.date.label') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('senzou::filament/resources/request-note.columns.location.label') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('senzou::filament/resources/request-note.columns.voyage_number.label') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('senzou::filament/resources/request-note.columns.remarks.label') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('senzou::filament/resources/request-note.columns.delivery_requirement.label') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            {{ __('senzou::filament/resources/request-note.columns.status.label') }}
                        </th>
                        <th scope="col" class="px-6 py-3">
                            <span class="sr-only">Action</span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notes as $note)
                        <tr
                            class="border-b bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white">
                                {{ $note->created_at->format('d F Y') }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $note->location }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $note->voyage_number }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $note->remarks }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $note->delivery_requirement }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $note->status }}
                            </td>
                            <td class="pr-6 text-right">

                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('senzou.request-notes.show', $note->id) }}"
                                        class="font-medium text-gray-600 hover:underline dark:text-blue-500">
                                        {{ __('senzou::filament/resources/request-note.columns.view.label') }}
                                    </a>

                                    @if (is_null($note->committed_at))
                                        @if (Auth::user()->isNahkoda())
                                            <form action="{{ route('senzou.request-notes.approve', $note->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="font-medium text-green-600 hover:underline dark:text-blue-500">
                                                    {{ __('senzou::filament/resources/request-note.columns.approve.label') }}
                                                </button>
                                            </form>
                                            <form action="{{ route('senzou.request-notes.reject', $note->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="font-medium text-red-600 hover:underline dark:text-blue-500">
                                                    {{ __('senzou::filament/resources/request-note.columns.reject.label') }}
                                                </button>
                                            </form>
                                        @else
                                            <a href="{{ route('senzou.request-notes.edit', $note->id) }}"
                                                class="font-medium text-blue-600 hover:underline dark:text-blue-500">
                                                {{ __('senzou::filament/resources/request-note.columns.edit.label') }}
                                            </a>
                                            <form onsubmit="return confirm('Are you sure to delete this data ?');"
                                                action="{{ route('senzou.request-notes.destroy', $note->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="font-medium text-red-600 hover:underline dark:text-blue-500">
                                                    {{ __('senzou::filament/resources/request-note.columns.delete.label') }}
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $notes->links() }}
        </div>
    @endif
@endsection
