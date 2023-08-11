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

        <header class="flex items-center justify-center">

            <div class="flex flex-col items-center">
                <h4 class="text-lg font-medium">{{ $company }}</h4>
                <span class="text-sm">{{ $title }}</span>
            </div>

        </header>

        <section class="my-2">

            <table class="w-full border divide-y text-sm">
                <thead>
                    <tr class="divide-x text-sm">
                        @foreach ($columns as $column)
                            <th class="py-1 font-semibold">{{ $column }}</th>
                        @endforeach
                    </tr>
                </thead>

                <tbody class="divide-y">
                    @foreach ($vessels as $vessel)
                        <tr class="divide-x">
                            <td class="px-2 py-1 text-center w-12">
                                <div>
                                    {{ $count++ }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $vessel->name }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $vessel->last_docked_at }}
                                </div>
                            </td>
                            <td class="px-2 py-1">
                                <div>
                                    {{ $vessel->next_docked_at }}
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
