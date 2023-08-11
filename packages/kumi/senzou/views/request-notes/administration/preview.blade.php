@php
    $count = 1;
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Request Note #{{ $requestNote->id }}</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            height: 99%;
        }
    </style>
</head>

<body class="font-inter">

    <main class="container mx-auto py-4">

        <header class="flex items-center justify-between">

            <x-senzou::logo class="h-16" />

            <div class="flex flex-col items-end">
                <span>
                    Jakarta, {{ $requestNote->created_at->format('d F Y') }}
                </span>
                <span class="font-bold">
                    Request Note #{{ $requestNote->id }} / {{ $requestNote->user->vessel->name }}
                </span>

            </div>

        </header>

        <hr class="my-4 mb-10 border-gray-500">

        <section class="my-4">

            <div class="flex h-16 flex-col items-end">
                <span>
                    Voyage No.{{ $requestNote->voyage_number }}
                </span>
                <span class="font-bold">
                    {{ $requestNote->remarks }} / {{ $requestNote->delivery_requirement }}
                </span>
            </div>

            <table class="w-full divide-y divide-gray-500 border border-gray-500 text-sm">
                <thead>
                    <tr class="divide-x divide-gray-500 text-sm">
                        <th class="py-1 font-semibold">No.</th>
                        <th class="py-1 font-semibold">Name</th>
                        <th class="py-1 font-semibold">Quantity</th>
                        <th class="py-1 font-semibold">Stock on Vessel</th>
                        <th class="py-1 font-semibold">Reason</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-500">
                    @foreach ($requestNote->approved_items as $approved)
                        <tr class="divide-x divide-gray-500">
                            <td class="w-12 px-2 py-1 text-center">
                                <div>
                                    {{ $count++ }}
                                </div>
                            </td>

                            <td class="px-2 py-1">
                                <div>
                                    {{ $approved->item->name }}
                                </div>
                            </td>

                            <td class="px-2 py-1 text-center">
                                <div>
                                    {{ $approved->quantity }}
                                </div>
                            </td>

                            <td class="px-2 py-1 text-center">
                                <div>
                                    {{ $approved->stock_on_vessel }}
                                </div>
                            </td>

                            <td class="px-2 py-1 text-center">
                                <div>
                                    {{ $approved->reason }}
                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

    </main>
</body>

</html>
