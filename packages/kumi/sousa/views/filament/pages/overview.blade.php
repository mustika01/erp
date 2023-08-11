<x-filament::page>

    <div class="relative" x-data="maps">
        <x-filament::card>
            <div class="grid grid-cols-8 gap-2">
                @foreach ($vessels as $vessel)
                    <label>
                        <input type="radio" name="selected_vessel" wire:model="selectedVesselID" wire:change="onSelectedVesselsChanged" value="{{ $vessel->id }}" />
                        <span>
                            {{ $vessel['name'] }}
                        </span>
                    </label>
                @endforeach
            </div>
        </x-filament::card>

        <div x-ref="gmap" class="w-full h-[640px] mt-8" wire:ignore></div>

        <div class="absolute bottom-0 left-0 bg-white border dark:bg-gray-800 dark:border-gray-600 w-96 z-50" x-show="currentVessel !== null">
            <template x-if="currentVessel">
                <div>
                    <div class="p-2 flex justify-end">
                        <x-filament::button size="sm" @click="currentVessel = null">
                            <x-heroicon-s-x class="w-4 h-4" />
                        </x-filament::button>
                    </div>

                    <table class="w-full text-xs border-t dark:border-gray-600">
                        <tbody class="divide-y dark:divide-gray-600">
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.name.label') }}</th>
                                <td class="p-1" x-text="currentVessel.name"></td>
                            </tr>
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.latitude.label') }}</th>
                                <td class="p-1" x-text="currentVessel.latitude"></td>
                            </tr>
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.longitude.label') }}</th>
                                <td class="p-1" x-text="currentVessel.longitude"></td>
                            </tr>
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.speed.label') }}</th>
                                <td class="p-1" x-text="currentVessel.speed"></td>
                            </tr>
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.cardinal_direction.label') }}</th>
                                <td class="p-1" x-text="currentVessel.cardinal_direction"></td>
                            </tr>
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.cardinal_angle.label') }}</th>
                                <td class="p-1" x-text="currentVessel.cardinal_angle + '°'"></td>
                            </tr>
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.status.label') }}</th>
                                <td class="p-1" x-text="currentVessel.status"></td>
                            </tr>
                            <tr class="divide-x dark:divide-gray-600">
                                <th class="p-1 w-48 text-left">{{ __('sousa::maps.columns.last_update.label') }}</th>
                                <td class="p-1" x-text="currentVessel.last_update"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </template>
        </div>
    </div>

</x-filament::page>

@push('scripts')
    <script
        src="https://maps.googleapis.com/maps/api/js?key={{ $this->getKey() }}&v=weekly"
    ></script>
    <script src="https://unpkg.com/@googlemaps/markerclusterer/dist/index.min.js"></script>

    <script defer>
        document.addEventListener('alpine:init', () => {
            Alpine.data('maps', () => ({
                options: {
                    zoom: 6,
                    center: { lat: -2.2097019, lng: 113.8666456 },
                    disableDefaultUI: true,
                    zoomControl: true,
                    mapTypeControl: true,
                },

                currentVessel: null,

                map: null,
                markers: [],
                markerCluster: null,

                markersData: {{ Js::from($markers) }},
                windowsData: {{ Js::from($windows) }},
                iconsData: {{ Js::from($icons) }},

                init() {
                    this.loadMap();
                    this.loadMarkers();
                    this.loadMarkerCluster();

                    Livewire.on('selected_vessels_changed', (event) => {
                        this.markersData = event.markers;
                        this.windowsData = event.windows;

                        this.loadMap();
                        this.loadMarkers();
                        this.loadMarkerCluster();
                    })
                },

                loadMap() {
                    this.map = new google.maps.Map(this.$refs.gmap, this.options);
                },

                loadMarkers() {
                    this.markers = this.markersData.map((vessel, index) => {
                        const marker = new google.maps.Marker({
                            position: { lat: vessel.latitude, lng: vessel.longitude },
                            icon: this.iconsData[vessel.angle],
                            map: this.map,
                            title: vessel.name,
                            label: vessel.name,
                        })

                        marker.addListener('click', () => {
                            this.currentVessel = this.windowsData[index]
                        })

                        return marker
                    })
                },

                loadMarkerCluster() {
                    this.markerCluster = new markerClusterer.MarkerClusterer({
                        map: this.map,
                        markers: this.markers,
                    })
                },
            }));
        });
    </script>
@endpush
