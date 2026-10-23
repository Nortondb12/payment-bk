<x-filament-panels::page>
    <x-filament::section>
        <x-slot name="heading">
            All Settings
        </x-slot>
        <x-slot name="description">
            Adjust and fine-tune all system features and preferences
        </x-slot>

        <div class="space-y-6">
            <!-- Search Form -->
            <div class="mx-auto max-w-md sm:mx-0">{{ $this->form }}</div>

            <!-- Search Status -->
            @if ($isSearching && $totalGroups > 0)
                <p class="text-sm text-gray-600 dark:text-gray-400">Showing {{ $totalGroups }} {{ str("result")->plural($totalGroups) }} for "{{ $searchQuery }}"</p>
            @endif

            <!-- Settings Grid -->
            @if ($totalGroups > 0)
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($settingGroups as $key => $group)
                        <a href="{{ $group["route"] }}" class="group block h-full w-full">
                            <x-filament::card>
                                <div class="flex items-center">
                                    @if (isset($group["icon"]))
                                        <x-filament::icon
                                            :icon="$group['icon']"
                                            class="bg-primary-50 dark:bg-primary-500/10 text-primary-500 h-12 w-12 shrink-0 rounded-lg p-3"
                                        />
                                    @endif

                                    <div class="ml-4">
                                        <h3
                                            class="group-hover:text-primary-600 dark:group-hover:text-primary-400 text-base font-medium text-gray-900 transition-colors dark:text-white"
                                        >
                                            {{ $group["label"] }}
                                        </h3>
                                        <p class="mt-1 line-clamp-2 text-sm text-gray-500 dark:text-gray-400">
                                            {{ $group["description"] }}
                                        </p>
                                    </div>
                                </div>
                            </x-filament::card>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <x-filament::icon
                        icon="heroicon-o-magnifying-glass"
                        class="mb-4 h-16 w-16 rounded-full bg-gray-100 p-4 text-gray-400 dark:bg-gray-700"
                    />
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">No settings found</h3>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        @if ($isSearching)
                            No settings match your search for "{{ $searchQuery }}"
                        @else
                            No settings available
                        @endif
                    </p>
                    @if ($isSearching)
                        <x-filament::button color="gray" class="mt-4" wire:click="$set('search', '')">
                            Clear Search
                        </x-filament::button>
                    @endif
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-panels::page>
