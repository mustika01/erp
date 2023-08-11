<x-dynamic-component
    :component="$getFieldWrapperView()"
    :id="$getId()"
    :label="$getLabel()"
    :label-sr-only="$isLabelHidden()"
    :helper-text="$getHelperText()"
    :hint="$getHint()"
    :hint-icon="$getHintIcon()"
    :required="$isRequired()"
    :state-path="$getStatePath()"
>
    @if ($isInline())
        <x-slot name="labelSuffix">
    @endif
    <x-filament-support::grid
        :default="$getColumns('default')"
        :sm="$getColumns('sm')"
        :md="$getColumns('md')"
        :lg="$getColumns('lg')"
        :xl="$getColumns('xl')"
        :two-xl="$getColumns('2xl')"
        :is-grid="! $isInline()"
        :attributes="$attributes->merge($getExtraAttributes())->class([
            'filament-forms-radio-component',
            'flex flex-wrap gap-3' => $isInline(),
            'gap-2' => ! $isInline(),
        ])"
    >
        @php
            $isDisabled = $isDisabled();
        @endphp

        @foreach ($getOptions() as $value => $label)
            <div @class([
                'gap-3' => ! $isInline(),
                'gap-2' => $isInline(),
            ])>
                <div class="flex items-center">
                    <label for="{{ $getId() }}-{{ $value }}" class="relative w-full cursor-pointer rounded-lg">
                        <input
                            name="{{ $getId() }}"
                            id="{{ $getId() }}-{{ $value }}"
                            type="radio"
                            value="{{ $value }}"
                            dusk="filament.forms.{{ $getStatePath() }}"
                        {{ $applyStateBindingModifiers('wire:model') }}="{{ $getStatePath() }}"
                        {{ $getExtraInputAttributeBag()->class([
                            'hidden peer',
                        ]) }}
                        {!! ($isDisabled || $isOptionDisabled($value, $label)) ? 'disabled' : null !!}
                        />
                        <div @class([
                            'flex justify-between items-center',
                            'font-medium',
                            'border rounded-lg px-4 py-2',
                            'bg-white dark:bg-gray-800' => ! $isOptionDisabled($value, $label),
                            'hover:text-gray-600 hover:bg-gray-100' => ! $isOptionDisabled($value, $label),
                            'opacity-50' => $isOptionDisabled($value, $label),
                            'peer-checked:bg-primary-100 peer-checked:text-primary-600 peer-checked:border-primary-600',
                            'peer-checked:checked-group',
                            'dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-200' => (! $errors->has($getStatePath())) && config('forms.dark_mode') && ! $isOptionDisabled($value, $label),
                            'dark:peer-checked:bg-primary-200 dark:peer-checked:text-primary-700' => (! $errors->has($getStatePath())) && config('forms.dark_mode') && ! $isOptionDisabled($value, $label),
                            'text-gray-700 dark:text-gray-100' => ! $errors->has($getStatePath()),
                            'text-danger-600' => $errors->has($getStatePath()),
                        ])>
                            <div class="block">
                                <div class="w-full text-sm checked-group label">
                                    {{ $label }}
                                </div>
                                <div class="w-full text-xs checked-group description text-gray-400">
                                    {{ $getDescription($value) }}
                                </div>
                            </div>
                        </div>
                        <div class="hidden text-primary-600 peer-checked:flex">
                            <div class="absolute top-1/2 right-4 -translate-y-1/2">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        @endforeach
    </x-filament-support::grid>
    @if ($isInline())
        </x-slot>
    @endif
</x-dynamic-component>
