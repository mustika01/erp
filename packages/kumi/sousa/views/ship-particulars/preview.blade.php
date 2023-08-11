<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <title>{{ "{$vessel->name} - Ship Particulars" }}</title>

    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">

    <style>
        html, body {
            height: 99%;
        }
    </style>
</head>

<body class="bg-white text-gray-900 font-sans antialiased text-sm">
    <main class="container mx-auto max-w-screen-md">
        <div class="flex flex-col divide-y divide-gray-900 border border-gray-900">
            {{-- Company Name & Vessel Name | START --}}
            <div class="flex w-full divide-x divide-gray-900">
                <div class="w-1/2 flex flex-col items-center justify-center px-4 py-2">
                    <span class="font-medium text-2xl">
                        PT. Lintas Bahari Nusantara
                    </span>
                </div>

                <div class="w-1/2 flex flex-col items-center px-4 py-2">
                    <div class="border-b-2 border-gray-900 pb-1 mb-1">
                        <span class="font-medium text-4xl uppercase">
                            {{ $vessel->name }}
                        </span>
                    </div>
                    <span class="uppercase">
                        {{ __('sousa::filament/resources/vessel.fields.vessel_type.options.' . $properties['vessel_type']) }}
                    </span>
                </div>
            </div>
            {{-- Company Name & Vessel Name | END --}}

            {{-- Vessel Image | START --}}
            <div>
                @if ($vessel->hasFeaturedImage())
                    <img src="{{ $vessel->featured_image_url }}" alt="{{ $vessel->name }}" class="h-[320px] w-full object-cover">
                @else
                    <img src="{{ asset('/images/placeholder-vessel.jpg') }}" alt="{{ $vessel->name }}" class="h-[320px] w-full object-cover">
                @endif
            </div>
            {{-- Vessel Image | END --}}

            {{-- Vessel Details | START --}}
            <div class="flex w-full divide-x divide-gray-900">
                <div class="w-1/2 flex flex-col">
                    <div class="bg-black text-white px-2 py-1">
                        Construction
                    </div>

                    <dl class="flex flex-col divide-y divide-gray-900">
                        <div class="flex divide-x divide-gray-900 last:!border-b">
                            <dt class="h-[57px] w-1/2 px-2 py-1 font-medium flex items-center">
                                Builder
                            </dt>
                            <dd class="flex-1 px-2 py-1 flex items-center">
                                {{ $properties['builder_name'] ?? '---' }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900 last:!border-b">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Hull Material
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['hull_material'] ?? '---' }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900 last:!border-b">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Year Built
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['year_built'] }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Registration Port
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['registration_port'] }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Flag Nationality
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['flag_nationality'] }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Registration Number
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['registration_number'] ?? '---' }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                IMO Number
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['imo_number'] ?? '---' }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Call Sign
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['call_sign'] ?? '---' }}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Classification
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                @unless (is_null($properties['classification']))
                                    {{ __('sousa::filament/resources/vessel.fields.classification.options.' . $properties['classification']) }}
                                @else
                                    ---
                                @endunless
                            </dd>
                        </div>
                    </dl>

                    <div class="bg-black text-white px-2 py-1">
                        Dimension & Capacity
                    </div>

                    <dl class="flex flex-col divide-y divide-gray-900">
                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Length
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ number_format($properties['length'], 2) }} m
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Breadth
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ number_format($properties['breadth'], 2) }} m
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Depth
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ number_format($properties['depth'], 2) }} m
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Draft
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ number_format($properties['draft'], 2) }} m
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Gross Tonnage
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['gross_tonnage'] }} t
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Net Tonnage
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['nett_tonnage'] ?? '---' }} t
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Dead Weight Tonnage
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['dead_weight_tonnage'] ?? '---' }} t
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="w-1/2 flex flex-col">
                    <div class="bg-black text-white px-2 py-1">
                        Engines
                    </div>

                    <dl class="flex flex-col divide-y divide-gray-900">
                        <div class="h-[144px] flex flex-col">
                            <dt class="w-1/2 px-2 py-1 font-medium border-r border-b border-gray-900">
                                Main Engine
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {!! $properties['main_engine'] ?? '---' !!}
                            </dd>
                        </div>

                        <div class="h-[145px] flex flex-col">
                            <dt class="w-1/2 px-2 py-1 font-medium border-r border-b border-gray-900">
                                Aux Engine
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {!! $properties['aux_engine'] ?? '---' !!}
                            </dd>
                        </div>
                    </dl>

                    <div class="bg-black text-white px-2 py-1">
                        Cranes & Speed
                    </div>

                    <dl class="flex flex-col divide-y divide-gray-900">
                        {{-- <div class="flex divide-x divide-gray-900 last:!border-b">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                No. of Cranes
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['crane_count'] }}
                            </dd>
                        </div> --}}

                        <div class="h-[115px] flex flex-col">
                            <dt class="w-1/2 px-2 py-1 font-medium border-r border-b border-gray-900">
                                Crane
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {!! $properties['crane_description'] ?? '---' !!}
                            </dd>
                        </div>

                        <div class="flex divide-x divide-gray-900 last:!border-b">
                            <dt class="w-1/2 px-2 py-1 font-medium">
                                Speed
                            </dt>
                            <dd class="flex-1 px-2 py-1">
                                {{ $properties['speed'] ?? '---' }} kn
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
            {{-- Vessel Details | END --}}
        </div>
    </main>
</body>

</html>
