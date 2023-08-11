<x-filament::widget class="filament-account-widget">
    <x-filament::card>
        <div class="flex items-center justify-between gap-8">
            <x-filament::card.heading>
                {{ $this->getHeading() }}
            </x-filament::card.heading>

            <div
                class="text-xs text-gray-500 dark:text-gray-400"
                {!! ($pollingInterval = $this->getPollingInterval()) ? "wire:poll.{$pollingInterval}=\"updateMinutesLabel\"" : '' !!}
            >
                {{ __('jinzai::filament/widgets/indonesia-puzzles.messages.next_puzzle_in', ['minutes' => $minutes]) }}
            </div>
        </div>

        <x-filament::hr />

        <blockquote class="relative text-xl italic  quote">
            <p class="mb-4">{{ $question }}</p>

            <div x-data="{
                'showAnswer': false,
            }">
                <cite x-show="showAnswer">
                    <span class="text-sm">
                        &mdash; {{ $answer }}
                    </span>
                </cite>

                <x-filament::button @click="showAnswer = true" x-show="! showAnswer">
                    {{ __('jinzai::filament/widgets/indonesia-puzzles.buttons.show.label') }}
                </x-filament::button>
            </div>
        </blockquote>
    </x-filament::card>
</x-filament::widget>
