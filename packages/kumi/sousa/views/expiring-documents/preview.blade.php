@php
    $count = 1;
@endphp

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>List of Vessels' Expiring Documents</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <style>
        html,
        body {
            height: 99%;
        }
    </style>
</head>

<body class="font-inter">

    <main class="container mx-auto py-2" x-data="{ showBankDetails: false }">

        <header class="flex items-center justify-center">

            <div class="flex flex-col items-center">
                <h4 class="text-lg font-medium">PT. Lintas Bahari Nusantara</h4>
                <span class="text-sm">List of Vessels' Expiring Documents</span>
            </div>

        </header>

        <section class="my-2">

            <table class="w-full divide-y border text-sm">
                <thead>
                    <tr class="divide-x text-sm">
                        @foreach ($columns as $column)
                            <th class="py-1 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($documents as $document)
                        <tr class="divide-x">
                            <td class="w-12 px-2 py-1 text-center">
                                <div>
                                    {{ $count++ }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    @if ($document->endorse_period_finished_at)
                                        {{ $document->endorse_period_finished_at->format('d F Y') }}
                                    @endif
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $document->expired_at->format('d F Y') }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $document->name }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $document->vessel->name }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $document->remarks }}
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
