<x-filament-panels::page>
    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Choose from {{ $this->totalIntegrations }} pre-built integrations for your platform.</p>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                <div class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <x-filament::icon icon="heroicon-m-magnifying-glass" class="size-4" />
                    </div>
                    <input
                        type="search"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search integrations..."
                        class="block w-full rounded-lg border-0 bg-white py-2 pl-10 pr-3 text-sm text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/10 dark:placeholder:text-gray-500 sm:w-72"
                    />
                </div>

                <select
                    wire:model.live="category"
                    class="block w-full rounded-lg border-0 bg-white py-2 pl-3 pr-10 text-sm text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-primary-600 dark:bg-white/5 dark:text-white dark:ring-white/10 sm:w-40"
                >
                    <option value="all">All</option>
                    @foreach ($this->categories as $key => $label)
                        <option value="{{ $key }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        @if (count($this->integrations) === 0)
            <div class="rounded-xl border border-dashed border-gray-300 px-6 py-16 text-center dark:border-white/10">
                <x-filament::icon
                    icon="heroicon-o-puzzle-piece"
                    class="mx-auto size-10 text-gray-400 dark:text-gray-500"
                />
                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400">No integrations match your filters.</p>
            </div>
        @else
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($this->integrations as $integration)
                    @php
                        $comingSoon = (bool) ($integration['coming_soon'] ?? false);
                        $categoryLabel = $this->categories[$integration['category'] ?? null] ?? '';
                    @endphp
                    <div
                        class="flex flex-col gap-4 rounded-xl border border-gray-200 bg-white p-5 transition hover:border-gray-300 dark:border-white/10 dark:bg-white/5 dark:hover:border-white/20"
                    >
                        <div class="flex items-center gap-3">
                            <div
                                class="flex size-12 shrink-0 items-center justify-center overflow-hidden rounded-lg bg-gray-100 dark:bg-white/5"
                            >
                                @if (! empty($integration['icon']))
                                    <img
                                        src="{{ secure_asset($integration['icon']) }}"
                                        alt="{{ $integration['name'] }}"
                                        class="size-8 object-contain"
                                        onerror="
                                            this.style.display = 'none';
                                            this.nextElementSibling.style.display = 'flex';
                                        "
                                    />
                                @endif
                                <div class="hidden size-8 items-center justify-center text-gray-400">
                                    <x-filament::icon icon="heroicon-o-puzzle-piece" class="size-6" />
                                </div>
                            </div>

                            <div class="min-w-0 flex-1">
                                <h3 class="truncate text-base font-semibold text-gray-950 dark:text-white">
                                    {{ $integration['name'] }}
                                </h3>
                                <p class="truncate text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">
                                    {{ $categoryLabel }}
                                </p>
                            </div>
                        </div>

                        @if ($comingSoon)
                            <button
                                type="button"
                                disabled
                                class="inline-flex w-full cursor-not-allowed items-center justify-center gap-x-2 rounded-lg bg-gray-100 px-3 py-2 text-sm font-medium text-gray-500 dark:bg-white/5 dark:text-gray-400"
                            >
                                Coming soon
                            </button>
                        @else
                            <a
                                href="{{ $integration['download_url'] }}"
                                target="_blank"
                                rel="noopener"
                                class="inline-flex w-full items-center justify-center gap-x-2 rounded-lg bg-gray-100 px-3 py-2 text-sm font-medium text-gray-900 transition hover:bg-gray-200 dark:bg-white/10 dark:text-white dark:hover:bg-white/20"
                            >
                                <x-filament::icon icon="heroicon-o-arrow-down-tray" class="size-4" />
                                Download
                            </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-filament-panels::page>
