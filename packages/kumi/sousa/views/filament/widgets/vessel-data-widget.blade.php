<div @class([
    'p-8 space-y-4 bg-white/50 backdrop-blur-xl border border-gray-200 shadow-2xl rounded-2xl relative',
    'dark:bg-gray-900/50 dark:border-gray-700' => config('filament.dark_mode'),
])>
    <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2 w-full">
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                {{ __('sousa::filament/resources/vessel.fields.name.label') }}
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $vessel->name }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                {{ __('sousa::filament/resources/vessel.fields.vessel_type.label') }}
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ __('sousa::filament/resources/vessel.fields.vessel_type.options.' . $vessel->properties['vessel_type']) }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                {{ __('sousa::filament/resources/vessel.fields.registration_port.label') }}
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ $vessel->properties['registration_port'] }}
            </dd>
        </div>
        <div class="sm:col-span-1">
            <dt class="text-sm font-medium text-gray-500">
                {{ __('sousa::filament/resources/vessel.fields.status.label') }}
            </dt>
            <dd class="mt-1 text-sm text-gray-900">
                {{ __('sousa::filament/resources/vessel.fields.status.options.' . $vessel->properties['status']) }}
            </dd>
        </div>
    </dl>
</div>
