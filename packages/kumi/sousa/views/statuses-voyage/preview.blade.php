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
    <main class="container mx-auto py-2" x-data="{ showBankDetails: false }"><br>
        <header class="flex items-center">
            <div class="flex flex-col">
                <x-senzou::logo class="h-10" />
            </div>
        </header>

        <hr class="mt-8 border-gray-500">

        <section class="my-6">
            <div class="mb-6 flex justify-center text-xl font-bold">
                <span class="flex items-center">{{ $title }}</span>
            </div>

            <table class="mb-6 w-full divide-y border text-sm">
                <tbody class="divide-y">
                    <tr class="divide-x">
                        <td class="w-48 px-2 py-1">
                            Name of Vessel&emsp;&emsp;&emsp;&emsp;&nbsp;: {{ $voyage->vessel->name }}
                        </td>
                    </tr>
                    <tr class="divide-x">
                        <td class="w-48 px-2 py-1">
                            Voyage Number&emsp;&emsp;&emsp;&emsp;: {{ $voyage->number }}
                        </td>
                    </tr>
                    <tr class="divide-x">
                        <td class="w-48 px-2 py-1">
                            Description of Cargo &emsp;&nbsp;&nbsp;: {{ $voyage->cargo_content }} - {{ $loading }}
                            Ton
                        </td>
                    </tr>
                    <tr class="divide-x">
                        <td class="w-48 px-2 py-1">
                            Port of Loading &emsp;&emsp;&emsp;&emsp;: {{ $voyage->originPort->name }},
                            {{ $voyage->originCity->name }}
                        </td>
                    </tr>
                    <tr class="divide-x">
                        <td class="w-48 px-2 py-1">
                            Port of Discharging &emsp;&emsp;&nbsp;: {{ $voyage->destinationPort->name }},
                            {{ $voyage->destinationCity->name }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="w-full divide-y border text-sm">
                <thead>
                    <tr class="divide-x text-sm">
                        @foreach ($columns as $column)
                            <th class="py-1 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($statuses as $status)
                        <tr class="divide-x">
                            <td class="w-12 px-2 py-1 text-center">
                                <div>
                                    {{ $count++ }}
                                </div>
                            </td>
                            <td class="w-36 px-8 py-1">
                                <div>
                                    &nbsp;{{ $status->executed_at->format('d F Y') }}
                                </div>
                            </td>
                            <td class="w-32 px-2 py-1">
                                <div>
                                    {{ $status->executed_at->format('g:i A') }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $status->description }}
                                </div>
                            </td>
                            <td class="w-48 px-2 py-1">
                                <div>
                                    {{ $status->remarks }}
                                </div>
                            </td>
                        </tr>
                        @if ($status->description === 'start-loading' || $status->description === 'start-unloading')
                            @foreach ($voyage->loadingCargoLogs as $cargolog)
                                <tr class="divide-x" x-show="">
                                    <td></td>
                                    <td>&nbsp;{{ $cargolog->executed_at->format('d F Y') }}</td>
                                    <td>&nbsp;&nbsp;{{ $cargolog->executed_at->format('g:i A') }}</td>
                                    <td class="px-2 py-1">
                                        &emsp;
                                        {{ $voyage->cargo_content }} - {{ $cargolog->tonnage_amount }} tonnage
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        @if ($status->description === 'finish-loading' || $status->description === 'finish-unloading')
                                <tr class="divide-x" x-show="">
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td class="px-2 py-1">
                                        &nbsp;&emsp;{{ $voyage->cargo_content }} - {{ $loading }} tonnage
                                    </td>
                                </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

            <br>

            <table class="border text-sm">
                <tfoot>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Tonnage Loaded &emsp;: {{ $loading }} t
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Tonnage Unloaded&nbsp;: {{ $unLoading }} t
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Bunker Usage &emsp;&emsp; : {{ $bunkerUsage }}<br>
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Bunker ROB &emsp;&emsp;&emsp; : {{ $bunkerROB }}
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Oil 90 Usage &emsp;&emsp;&nbsp;&nbsp;&nbsp;: {{ $oilUsage90 }}
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Oil 90 ROB &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;: {{ $oilROB90 }}
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Oil 40 Usage &emsp;&emsp;&nbsp;&nbsp;&nbsp;: {{ $oilUsage40 }}
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Oil 40 ROB &emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;: {{ $oilROB40 }}
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Oil 10 ROB&emsp;&emsp;&emsp;&emsp;&nbsp;: {{ $oilROB10 }}
                        </td>
                    </tr>
                    <tr class="divide-x" x-show="">
                        <td class="px-2 py-1">
                            Oil 10 Usage &emsp;&emsp;&nbsp;&nbsp;&nbsp;&nbsp;: {{ $oilUsage10 }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </section>
    </main>
</body>

</html>
