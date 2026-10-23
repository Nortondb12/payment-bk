<div wire:poll.{{ $updateInProgress ? "3" : "30" }}s="refreshProgress" class="space-y-6">
    <x-filament-panels::page>
        {{-- Up to date --}}
        @if ((! $updateAvailable && ! $updateInProgress && $updateInfo) || is_null($updateInfo))
            <x-filament::section>
                <div class="py-12 text-center">
                    <div class="relative">
                        <x-heroicon-o-check-circle class="text-success-500 mx-auto h-20 w-20" />
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="bg-success-500 h-12 w-12 animate-ping rounded-full opacity-20"></div>
                        </div>
                    </div>
                    <h3 class="mt-6 text-xl font-bold text-gray-900 dark:text-white">Your application is up to date</h3>
                    <p class="mt-3 text-gray-600 dark:text-gray-400">You're on the latest version. No action required.</p>
                    <div class="mt-4 flex items-center justify-center gap-4 text-sm text-gray-500">
                        <span>Current: v{{ $updateInfo["current_version"] ?? "Unknown" }}</span>
                        <span>•</span>
                        <span>Last checked: {{ now()->format("M j, Y H:i A") }}</span>
                    </div>
                </div>
            </x-filament::section>
        @endif

        {{-- Cards --}}
        @if (($updateAvailable || $updateInProgress) && $updateInfo)
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center justify-between">
                        <span class="flex items-center gap-2">
                            <x-heroicon-o-arrow-path class="text-primary-500 h-5 w-5" />
                            <span>System Overview</span>
                        </span>
                        <span class="text-xs text-gray-500">
                            Current: v{{ $updateInfo["current_version"] ?? "—" }}
                            <span class="mx-1">•</span>
                            Latest: v{{ $updateInfo["latest_version"] ?? "—" }}
                        </span>
                    </div>
                </x-slot>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    {{-- Current Version --}}
                    <div
                        class="flex items-center gap-3 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                    >
                        <x-heroicon-o-computer-desktop class="h-8 w-8 text-blue-500" />
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Current Version</p>
                            <p class="text-lg font-semibold">{{ $updateInfo["current_version"] ?? "Unknown" }}</p>
                        </div>
                    </div>

                    {{-- New Version --}}
                    <div
                        class="flex items-center gap-3 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                    >
                        <x-heroicon-o-arrow-up-circle class="h-8 w-8 text-emerald-500" />
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">New Version</p>
                            <p class="text-lg font-semibold">
                                {{ $updateInfo["latest_version"] ?? ($updateAvailable ? "Unknown" : $updateInfo["current_version"] ?? "Unknown") }}
                            </p>
                        </div>
                    </div>

                    {{-- Update Status --}}
                    <div
                        class="flex items-center gap-3 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                    >
                        @if ($updateInProgress)
                            <x-heroicon-o-arrow-path class="h-8 w-8 animate-spin text-amber-500" />
                        @elseif ($updateAvailable)
                            <x-heroicon-o-exclamation-triangle class="h-8 w-8 text-amber-500" />
                        @else
                            <x-heroicon-o-shield-check class="h-8 w-8 text-green-500" />
                        @endif
                        <div>
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Update Status</p>
                            <p class="text-lg font-semibold">
                                @if ($updateInProgress)
                                    <span class="text-amber-600">In Progress</span>
                                @elseif ($updateAvailable)
                                    <span class="text-amber-600">Update Available</span>
                                @else
                                    <span class="text-green-600">Up to Date</span>
                                @endif
                            </p>
                            @if ($updateInProgress && $currentProgress)
                                <p class="text-xs capitalize text-gray-500">
                                    {{ ucfirst($currentProgress["step"] ?? "preparing") }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </x-filament::section>
        @endif

        {{-- Progress --}}
        @if ($updateInProgress && $currentProgress)
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        <x-heroicon-o-arrow-path class="h-5 w-5 animate-spin text-amber-500" />
                        <span class="font-semibold">Update in Progress</span>
                        @if ($currentProgress["version"] ?? null)
                            <span class="text-xs text-gray-500">v{{ $currentProgress["version"] }}</span>
                        @endif
                    </div>
                </x-slot>

                <div class="space-y-4">
                    <div class="flex justify-between text-sm">
                        <span class="flex items-center gap-1 text-gray-700 dark:text-gray-300">
                            <x-heroicon-o-chart-bar class="text-primary-500 h-4 w-4" />
                            Overall Progress
                        </span>
                        <span class="font-medium">{{ $currentProgress["percent"] ?? 0 }}%</span>
                    </div>

                    <div class="h-4 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                        <div
                            class="from-primary-500 to-primary-600 h-4 rounded-full bg-gradient-to-r transition-all duration-700 ease-out"
                            style="width: {{ $currentProgress["percent"] ?? 0 }}%"
                        ></div>
                    </div>

                    <div
                        class="flex flex-wrap items-center justify-between gap-3 text-xs text-gray-500 dark:text-gray-400"
                    >
                        <div class="flex items-center gap-1 capitalize">
                            <x-heroicon-o-information-circle class="h-4 w-4 text-gray-400" />
                            <span>{{ ucfirst($currentProgress["step"] ?? "preparing") }}</span>
                        </div>
                    </div>

                    @if ($currentProgress["message"] ?? null)
                        <div
                            class="mt-2 flex items-center gap-2 rounded-lg bg-gray-50 p-3 text-sm text-gray-600 dark:bg-gray-800/60 dark:text-gray-300"
                        >
                            <x-heroicon-o-chat-bubble-left-right class="h-4 w-4 text-gray-400" />
                            <span class="italic">{{ $currentProgress["message"] }}</span>
                        </div>
                    @endif

                    @if ($currentProgress["error"] ?? null)
                        <div
                            class="mt-2 flex items-center gap-2 rounded-lg bg-red-50 p-3 text-sm text-red-600 dark:bg-red-900/20 dark:text-red-400"
                        >
                            <x-heroicon-o-exclamation-circle class="h-4 w-4" />
                            <span>{{ $currentProgress["error"] }}</span>
                        </div>
                    @endif
                </div>
            </x-filament::section>
        @endif

        {{-- Release Notes --}}
        @if (! $updateInProgress && $updateAvailable && ! empty($updateInfo["release"]["changelog"] ?? ""))
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-purple-500 to-purple-600"
                        >
                            <x-heroicon-o-document-text class="h-4 w-4 text-white" />
                        </div>
                        <div>
                            <span class="text-lg font-semibold">Release Notes</span>
                            <p class="text-sm text-gray-500 dark:text-gray-400">What's new in this version</p>
                        </div>
                    </div>
                </x-slot>
                <div class="prose prose-sm prose-gray dark:prose-invert max-w-none space-y-4">
                    <div class="js-markdown">
                        {!! \Illuminate\Support\Str::markdown($updateInfo["release"]["changelog"]) !!}
                    </div>
                </div>
            </x-filament::section>
        @endif
    </x-filament-panels::page>
</div>
