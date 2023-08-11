@php
    $count = 1;
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>Delivery Note #{{ $deliveryNote->id }}</title>

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
                    Jakarta, {{ $deliveryNote->date->format('d F Y') }}
                </span>
                <span class="font-bold">
                    Delivery Note #{{ $deliveryNote->id }} / {{ $deliveryNote->vessel->name }}
                </span>
            </div>

        </header>

        <hr class="my-4 border-gray-500">

        <section class="flex justify-end">
            <div class="h-28 w-72 border border-gray-500 p-2">
                <span class="text-sm">Notes:</span>
            </div>
        </section>

        <section class="my-4">
            <table class="w-full divide-y divide-gray-500 border border-gray-500 text-sm">
                <thead>
                    <tr class="divide-x divide-gray-500 text-sm">
                        <th class="py-1 font-semibold">No.</th>
                        <th class="py-1 font-semibold">Item</th>
                        <th class="py-1 font-semibold">Quantity</th>
                        <th class="py-1 font-semibold">Remarks</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-500">
                    @foreach ($deliveryNote->entries as $entry)
                        <tr class="divide-x divide-gray-500">
                            <td class="w-12 px-2 py-1 text-center">
                                <div>
                                    {{ $count++ }}
                                </div>
                            </td>

                            <td class="px-2 py-1">
                                <div>
                                    {{ $entry->item->name }}
                                </div>
                            </td>

                            <td class="w-24 px-2 py-1 text-center">
                                <div>
                                    {{ $entry->quantity }} {{ $entry->item->measurement_symbol }}
                                </div>
                            </td>

                            <td class="w-24 px-2 py-1 text-center">
                                <div>
                                    @lang('senzou::filament/resources/delivery-note.fields.remarks.options.' . $entry->remarks)
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        <section class="mt-4 grid grid-cols-3">
            <div class="flex flex-col text-sm">
                <span class="text-center font-bold">Checked By</span>
                <span class="h-28"></span>
                <div class="flex justify-between px-12">
                    <span>(</span>
                    <span>)</span>
                </div>
            </div>
            <div class="flex flex-col text-sm">
                <span class="text-center font-bold">Received By</span>
                <span class="h-28"></span>
                <div class="flex justify-between px-12">
                    <span>(</span>
                    <span>)</span>
                </div>
            </div>
            <div class="flex flex-col text-sm">
                <span class="text-center font-bold">Submitted By</span>
                <span class="h-28"></span>
                <div class="flex justify-between px-12">
                    <span>(</span>
                    <span>)</span>
                </div>
            </div>
        </section>

    </main>
</body>

</html>
