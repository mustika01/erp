@php
    $count = 1;
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
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

            <x-senzou::logo class="h-10" />

        </header>

        <hr class="my-4 border-gray-500">

        <section class="my-4">
            <div class="flex flex-col text-center">
                <span class="pb-4 font-bold">
                    Delivery Note Daily Report
                </span>
            </div>

            <table class="w-full divide-y divide-gray-500 border border-gray-500 text-sm">
                <thead>
                    <tr class="divide-x divide-gray-500 text-sm">
                        <th class="py-1 font-semibold">No.</th>
                        <th class="py-1 font-semibold">Date</th>
                        <th class="py-1 font-semibold">Item</th>
                        <th class="py-1 font-semibold">Quantity</th>
                        <th class="py-1 font-semibold">Vessel</th>
                        <th class="py-1 font-semibold">Remarks</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-500">
                    @foreach ($entries as $entry)
                        <tr class="divide-x divide-gray-500">
                            <td class="w-0 px-2 py-1 text-center">
                                <div>
                                    {{ $count++ }}
                                </div>
                            </td>
                            <td class="w-16 px-2 py-1 text-center">
                                <div>
                                    {{ $entry->note->date->format('d-m-Y') }}
                                </div>
                            </td>
                            <td class="w-64 px-2 py-1 text-center">
                                <div>
                                    {{ $entry->item->name }}
                                </div>
                            </td>
                            <td class="w-2 px-2 py-1 text-center">
                                <div>
                                    {{ $entry->quantity }} {{ $entry->item->measurement_symbol }}
                                </div>
                            </td>
                            <td class="w-3 px-2 py-1 text-center">
                                <div>
                                    {{ $entry->note->vessel->name }}
                                </div>
                            </td>
                            <td class="w-2 px-2 py-1 text-center">
                                <div>
                                    {{ $entry->remarks }}
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
