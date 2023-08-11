<x-filament::widget class="filament-account-widget">
    <x-filament::card>
        <div class="flex justify-between">
            <div class="flex flex-col">
                <div class="h-12 flex items-center space-x-4 rtl:space-x-reverse">
                    <div
                        class="w-10 h-10 rounded-full bg-gray-200 bg-cover bg-center"
                        style="background-image: url('{{ $userAvatarUrl }}')"
                    ></div>

                    <div>
                        <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                            {{ __('jinzai::filament/widgets/welcome.messages.greeting', [
                                'user' => $userDisplayName,
                                'greeting' => $this->getGreeting(),
                            ]) }}
                        </h2>

                        <p class="text-gray-600 text-sm">
                            {{ __('jinzai::filament/widgets/welcome.messages.subtitle', [
                                'date' => $this->getDate(),
                            ]) }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-col class mt-6">
                    <h4 class="text-xs font-medium">
                        {{ __('jinzai::filament/widgets/welcome.headings.shortcuts') }}
                    </h4>

                    <div class="flex space-x-4 mt-2">
                        @foreach ($this->getLinks() as $link)
                            <x-filament::button tag="a" href="{{ $link['url'] }}" color="secondary">
                                {{ $link['label'] }}
                            </x-filament::button>
                        @endforeach

                        <form action="{{ route('filament.auth.logout') }}" method="post" class="text-sm">
                            @csrf

                            <x-filament-support::button
                                type="submit"
                                color="gray"
                                size="sm"
                            >
                                {{ __('filament::widgets/account-widget.buttons.logout.label') }}
                            </x-filament-support::button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="translate-y-4">
                <img src="{{ asset('/vendor/jinzai/svgs/welcome-workspace.svg') }}" alt="Welcome" class="h-32">
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
