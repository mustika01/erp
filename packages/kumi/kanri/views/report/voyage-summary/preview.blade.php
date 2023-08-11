@php
    $count = 1;
@endphp

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $title }}</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="//unpkg.com/alpinejs" defer></script>
    <style>
        .font-inter {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="font-inter">

    <main class="container mx-auto py-2" x-data="{ showBankDetails: false }">

        <header class="flex items-center">

            <div class="flex flex-col">
                <x-senzou::logo class="h-10" />
            </div>

        </header>
        <hr class="mt-8 border-gray-500">

        <section class="my-2 mt-8">
            <div class="mb-3 flex justify-center">
                <span class="text-lg font-bold">{{ $title }}</span>
            </div>
            <table class="mb-3 w-full divide-y border text-sm">
                <thead>
                    <tr class="divide-x text-sm">
                        @foreach ($columns as $column)
                            <th class="py-1 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($groupVessels as $vessel => $voyages)
                        <tr class="bg-gray-100">
                            <td class="p-2 font-semibold" colspan="6">
                                <div class="text-base">
                                    {{ $vessel }}
                                </div>
                            </td>
                            <td class="border-l p-2 text-right font-semibold">
                                <div class="text-base">
                                    Total Voyages : {{ $voyages->count() }}
                                </div>
                            </td>
                        </tr>
                        @foreach ($voyages as $voyage)
                            <tr class="divide-x">
                                <td class="w-12 px-2 py-1 text-center">
                                    <div>
                                        {{ $count++ }}
                                    </div>
                                </td>
                                <td class="px-2 py-1">
                                    <div>
                                        {{ $voyage->vessel->name }}
                                    </div>
                                </td>
                                <td class="px-2 py-1">
                                    <div>
                                        {{ $voyage->number }}
                                    </div>
                                </td>
                                <td class="px-2 py-1">
                                    <div>
                                        {{ $voyage->originCity->name }}
                                    </div>
                                </td>
                                <td class="px-2 py-1">
                                    <div>
                                        {{ $voyage->destinationCity->name }}
                                    </div>
                                </td>
                                <td class="px-2 py-1">
                                    <div>
                                        {{ $voyage->cargo_content }}
                                    </div>
                                </td>
                                <td class="px-2 py-1">
                                    <div>
                                        Total :{{ $voyage->loadingCargoLogs->sum('tonnage_amount') }} t
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            <td><span class="text-lg font-bold">Total : {{ $totalVoyage }} Voyage</span></td>
        </section>
    </main>
</body>

</html>
