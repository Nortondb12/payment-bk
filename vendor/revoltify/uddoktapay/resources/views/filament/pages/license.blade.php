<div wire:poll.{{ $validating ? "3" : "30" }}s="$dispatch('$refresh')">
    <x-filament-panels::page>
        <div class="space-y-6">
            {{-- License Status Overview --}}
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center justify-between">
                        <span>License Status</span>
                        @if ($licenseInfo && isset($licenseInfo["synced_at"]))
                            <span class="text-xs text-gray-500">
                                Last synced: {{ \Carbon\CarbonImmutable::parse($licenseInfo["synced_at"])->diffForHumans() }}
                            </span>
                        @endif
                    </div>
                </x-slot>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                    {{-- License Status Card --}}
                    <div
                        class="flex items-center space-x-3 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                    >
                        <div class="flex-shrink-0">
                            @if ($isActive && ! $isExpired && ! $isInGracePeriod)
                                <x-heroicon-o-shield-check class="h-8 w-8 text-success-500" />
                            @elseif ($isInGracePeriod)
                                <x-heroicon-o-clock class="h-8 w-8 text-warning-500" />
                            @elseif ($isExpired)
                                <x-heroicon-o-exclamation-triangle class="h-8 w-8 text-danger-500" />
                            @else
                                <x-heroicon-o-shield-exclamation class="h-8 w-8 text-warning-500" />
                            @endif
                        </div>
                        <div class="min-w-0 flex-1">
                            <p class="text-sm font-medium text-gray-900 dark:text-white">Status</p>
                            <p class="text-lg font-semibold">
                                @if ($isActive && ! $isExpired && ! $isInGracePeriod)
                                    <span class="text-success-600 dark:text-success-400">
                                        {{ $licenseState->label() }}
                                    </span>
                                @elseif ($isInGracePeriod)
                                    <span class="text-warning-600 dark:text-warning-400">Grace Period</span>
                                @elseif ($isExpired)
                                    <span class="text-danger-600 dark:text-danger-400">Expired</span>
                                @else
                                    <span class="text-warning-600 dark:text-warning-400">
                                        {{ $licenseState->label() }}
                                    </span>
                                @endif
                            </p>
                            @if ($licenseInfo && isset($licenseInfo["type"]))
                                <p class="text-xs capitalize text-gray-500">
                                    {{ str_replace("_", " ", $licenseInfo["type"]) }}
                                </p>
                            @endif
                        </div>
                    </div>

                    {{-- Customer Info Card --}}
                    @if ($licenseInfo && isset($licenseInfo["customer_name"]))
                        <div
                            class="flex items-center space-x-3 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                        >
                            <div class="flex-shrink-0">
                                <x-heroicon-o-user class="h-8 w-8 text-primary-500" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Licensed To</p>
                                <p class="truncate text-lg font-semibold text-primary-600 dark:text-primary-400">
                                    {{ $licenseInfo["customer_name"] }}
                                </p>
                                @if (isset($licenseInfo["customer_email"]))
                                    <p class="truncate text-xs text-gray-500">{{ $licenseInfo["customer_email"] }}</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    {{-- Expiration Card --}}
                    @if ($licenseInfo && ! $isLifetime && isset($licenseInfo["expires_at"]))
                        <div
                            class="flex items-center space-x-3 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                        >
                            <div class="flex-shrink-0">
                                @if ($isExpired)
                                    <x-heroicon-o-clock class="h-8 w-8 text-danger-500" />
                                @else
                                    @php
                                        $daysUntilExpiry = \Carbon\CarbonImmutable::parse($licenseInfo["expires_at"])->diffInDays(now());
                                        $isExpiringSoon = $daysUntilExpiry <= 30;
                                    @endphp
                                    <x-heroicon-o-calendar
                                        class="{{ $isExpiringSoon ? 'text-warning-500' : 'text-success-500' }} h-8 w-8"
                                    />
                                @endif
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">
                                    {{ $isExpired ? "Expired" : "Expires" }}
                                </p>
                                <p
                                    class="{{ $isExpired ? "text-danger-600 dark:text-danger-400" : "text-gray-600 dark:text-gray-400" }} text-lg font-semibold"
                                >
                                    {{ \Carbon\CarbonImmutable::parse($licenseInfo["expires_at"])->format("M j, Y g:i A") }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ \Carbon\CarbonImmutable::parse($licenseInfo["expires_at"])->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    @endif

                    {{-- Lifetime License Card --}}
                    @if ($licenseInfo && $isLifetime)
                        <div
                            class="flex items-center space-x-3 rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                        >
                            <div class="flex-shrink-0">
                                <x-heroicon-o-rocket-launch class="h-8 w-8 text-success-500" />
                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Expiration</p>
                                <p class="text-lg font-semibold text-success-600 dark:text-success-400">Never Expires</p>
                                <p class="text-xs text-gray-500">Lifetime License</p>
                            </div>
                        </div>
                    @endif
                </div>
            </x-filament::section>

            {{-- No License Found --}}
            @if (! $isActive && ! $licenseInfo && ! $validating)
                <x-filament::section>
                    <div class="py-12 text-center">
                        <x-heroicon-o-key class="mx-auto h-20 w-20 text-warning-500" />
                        <h3 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">No License Found</h3>
                        <p class="mx-auto mt-3 max-w-md text-gray-600 dark:text-gray-400">Please validate your license to activate this software and access all features.</p>
                        <div class="mt-6 space-y-2 text-sm text-gray-500">
                            <div class="flex items-center justify-center space-x-2">
                                <x-heroicon-o-check class="h-4 w-4" />
                                <span>Enter your license key using the "Validate License" button above</span>
                            </div>
                            <div class="flex items-center justify-center space-x-2">
                                <x-heroicon-o-check class="h-4 w-4" />
                                <span>Contact support if you need assistance</span>
                            </div>
                        </div>
                    </div>
                </x-filament::section>
            @endif

            {{-- Grace Period Warning (Expired but still in cache period) --}}
            @if ($isInGracePeriod && $gracePeriodInfo)
                <x-filament::section>
                    <x-slot name="heading">
                        <div class="flex items-center space-x-2">
                            <x-heroicon-o-clock class="h-5 w-5 text-warning-500" />
                            <span>License Renewal Required</span>
                        </div>
                    </x-slot>

                    <div
                        class="rounded-lg border border-warning-200 bg-warning-50 p-4 dark:border-warning-800 dark:bg-warning-900/20"
                    >
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <x-heroicon-o-clock class="mt-0.5 h-5 w-5 flex-shrink-0 text-warning-500" />
                                <div class="text-sm">
                                    <p class="font-medium text-warning-800 dark:text-warning-200">Your License Has Expired - Grace Period Active</p>
                                    <p class="mt-1 text-warning-700 dark:text-warning-300">Your license expired on {{ \Carbon\CarbonImmutable::parse($gracePeriodInfo["expired_at"])->format("M j, Y g:i A") }}. The system is currently running in grace period which ends on
                                    <strong>{{ \Carbon\CarbonImmutable::parse($gracePeriodInfo["grace_ends_at"])->format("M j, Y g:i A") }}</strong>
                                    ({{ $gracePeriodInfo["days_remaining"] }} days remaining).</p>
                                </div>
                            </div>
                            <div class="mt-4 rounded-md bg-warning-100 p-3 dark:bg-warning-800/30">
                                <p class="text-sm font-medium text-warning-800 dark:text-warning-200">⏰ Please renew your license before the grace period ends to avoid service interruption.</p>
                            </div>
                        </div>
                    </div>
                </x-filament::section>
            @endif

            {{-- License Expired Warning (No grace period) --}}
            @if ($isExpired && $licenseInfo && ! $isInGracePeriod)
                <x-filament::section>
                    <x-slot name="heading">
                        <div class="flex items-center space-x-2">
                            <x-heroicon-o-exclamation-triangle class="h-5 w-5 text-danger-500" />
                            <span>License Expired</span>
                        </div>
                    </x-slot>

                    <div
                        class="rounded-lg border border-danger-200 bg-danger-50 p-4 dark:border-danger-800 dark:bg-danger-900/20"
                    >
                        <div class="space-y-3">
                            <div class="flex items-start space-x-3">
                                <x-heroicon-o-exclamation-triangle
                                    class="mt-0.5 h-5 w-5 flex-shrink-0 text-danger-500"
                                />
                                <div class="text-sm">
                                    <p class="font-medium text-danger-800 dark:text-danger-200">Your License Has Expired</p>
                                    <p class="mt-1 text-danger-700 dark:text-danger-300">Your license expired on {{ \Carbon\CarbonImmutable::parse($licenseInfo["expires_at"])->format("M j, Y g:i A") }}. Please renew your license to continue using this software.</p>
                                </div>
                            </div>
                            <div class="mt-4 rounded-md bg-danger-100 p-3 dark:bg-danger-800/30">
                                <p class="text-sm font-medium text-danger-800 dark:text-danger-200">⚠️ Some features may be disabled until your license is renewed</p>
                            </div>
                        </div>
                    </div>
                </x-filament::section>
            @endif

            {{-- Domain Information --}}
            @if ($licenseInfo && isset($licenseInfo["domains"]))
                <x-filament::section>
                    <x-slot name="heading">
                        Domain Authorization
                    </x-slot>

                    <div class="space-y-4">
                        @if ($isUnlimitedDomains)
                            <div
                                class="rounded-lg border border-purple-200 bg-purple-50 p-4 dark:border-purple-800 dark:bg-purple-900/20"
                            >
                                <div class="flex items-center space-x-3">
                                    <x-heroicon-o-cpu-chip class="h-5 w-5 text-purple-500" />
                                    <div class="text-sm">
                                        <p class="font-medium text-purple-800 dark:text-purple-200">Unlimited Authorized Domains</p>
                                        <p class="mt-1 text-purple-700 dark:text-purple-300">This license allows access from any domain without restrictions.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                        Authorized Domains
                                    </h4>
                                    @if (isset($licenseInfo["max_domains"]))
                                        <span class="text-xs text-gray-500">
                                            {{ count($licenseInfo["domains"]) }}/{{ $licenseInfo["max_domains"] }} used
                                        </span>
                                    @endif
                                </div>
                                <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
                                    @foreach ($licenseInfo["domains"] as $domain)
                                        @php
                                            $isCurrentDomain = $domain === request()->getHost();
                                        @endphp
                                        <div
                                            class="{{ $isCurrentDomain ? "border-success-200 bg-success-50 dark:border-success-800 dark:bg-success-900/20" : "border-gray-200 bg-gray-50 dark:border-gray-700 dark:bg-gray-800" }} flex items-center space-x-3 rounded-lg border p-3"
                                        >
                                            @if ($isCurrentDomain)
                                                <x-heroicon-o-check-circle
                                                    class="h-4 w-4 flex-shrink-0 text-success-500"
                                                />
                                            @else
                                                <x-heroicon-o-globe-alt class="h-4 w-4 flex-shrink-0 text-gray-400" />
                                            @endif
                                            <div class="min-w-0 flex-1">
                                                <p
                                                    class="{{ $isCurrentDomain ? "text-success-800 dark:text-success-200" : "text-gray-900 dark:text-white" }} truncate text-sm font-medium"
                                                >
                                                    {{ $domain }}
                                                </p>
                                                @if ($isCurrentDomain)
                                                    <p class="text-xs text-success-600 dark:text-success-400">Current Domain</p>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </x-filament::section>
            @endif

            {{-- API Domains Section --}}
            @if ($apiDomainsInfo)
                <x-filament::section>
                    <x-slot name="heading">
                        API Access Domains
                    </x-slot>

                    <div class="space-y-4">
                        @if ($apiDomainsInfo["unlimited"])
                            <div
                                class="rounded-lg border border-purple-200 bg-purple-50 p-4 dark:border-purple-800 dark:bg-purple-900/20"
                            >
                                <div class="flex items-center space-x-3">
                                    <x-heroicon-o-cpu-chip class="h-5 w-5 text-purple-500" />
                                    <div class="text-sm">
                                        <p class="font-medium text-purple-800 dark:text-purple-200">Unlimited API Access</p>
                                        <p class="mt-1 text-purple-700 dark:text-purple-300">This license allows API access from any domain without restrictions.</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-900 dark:text-white">
                                            Authorized API Domains
                                        </h4>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">Domains authorized to make API calls to this panel</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="text-xs text-gray-500">
                                            {{ count($apiDomainsInfo["domains"]) }}/{{ $apiDomainsInfo["max"] ?? "∞" }} used
                                        </span>

                                        @if ($apiDomainsInfo["remaining"] !== null && $apiDomainsInfo["remaining"] > 0)
                                            <p class="text-xs text-success-600 dark:text-success-400">
                                                {{ $apiDomainsInfo["remaining"] }} remaining
                                            </p>
                                        @elseif ($apiDomainsInfo["remaining"] === 0)
                                            <p class="text-xs text-warning-600 dark:text-warning-400">Limit reached</p>
                                        @endif
                                    </div>
                                </div>

                                @if (count($apiDomainsInfo["domains"]) > 0)
                                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
                                        @foreach ($apiDomainsInfo["domains"] as $domain)
                                            <div
                                                class="flex items-center space-x-3 rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-800"
                                            >
                                                <x-heroicon-o-cpu-chip class="h-4 w-4 flex-shrink-0 text-purple-500" />
                                                <div class="min-w-0 flex-1">
                                                    <p
                                                        class="truncate text-sm font-medium text-gray-900 dark:text-white"
                                                    >
                                                        {{ $domain }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div
                                        class="rounded-lg border border-gray-200 bg-gray-50 p-4 text-center dark:border-gray-700 dark:bg-gray-800"
                                    >
                                        <x-heroicon-o-globe-alt class="mx-auto h-8 w-8 text-gray-400" />
                                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">No API domains registered yet</p>
                                        <p class="text-xs text-gray-500">API domains will be added automatically when API requests are made</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </x-filament::section>
            @endif

            {{-- Addons Section --}}
            @if (count($addons) > 0)
                <x-filament::section>
                    <x-slot name="heading">
                        Available Addons
                    </x-slot>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($addons as $addon)
                            <div
                                class="rounded-lg border border-green-200 bg-green-50 p-4 dark:border-green-800 dark:bg-green-900/20"
                            >
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center space-x-3">
                                        <div class="flex-shrink-0">
                                            <div
                                                class="flex h-8 w-8 items-center justify-center rounded-full bg-success-100 dark:bg-success-900/30"
                                            >
                                                <x-heroicon-o-puzzle-piece
                                                    class="h-4 w-4 text-success-600 dark:text-success-400"
                                                />
                                            </div>
                                        </div>
                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                                {{ $addon["name"] ?? $addon["slug"] }}
                                            </p>
                                            @if (isset($addon["slug"]) && isset($addon["name"]))
                                                <p class="text-xs text-gray-500">{{ $addon["slug"] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-filament::section>
            @endif

            {{-- License Details --}}
            @if ($licenseInfo)
                <x-filament::section>
                    <x-slot name="heading">
                        License Information
                    </x-slot>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">
                        {{-- License Key --}}
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                        >
                            <div class="mb-2 flex items-center space-x-2">
                                <div class="h-2 w-2 rounded-full bg-primary-500"></div>
                                <span class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    License Key
                                </span>
                            </div>
                            <p class="font-mono text-sm text-gray-900 dark:text-white">
                                @if (isset($licenseInfo["key"]))
                                    {{ substr($licenseInfo["key"], 0, 8) }}...{{ substr($licenseInfo["key"], -4) }}
                                @else
                                    Hidden
                                @endif
                            </p>
                        </div>

                        {{-- License Type --}}
                        @if (isset($licenseInfo["type"]))
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                            >
                                <div class="mb-2 flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full bg-blue-500"></div>
                                    <span class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                        License Type
                                    </span>
                                </div>
                                <p class="text-sm font-semibold capitalize text-gray-900 dark:text-white">
                                    {{ str_replace("_", " ", $licenseInfo["type"]) }}
                                </p>
                            </div>
                        @endif

                        {{-- Product Name --}}
                        @if (isset($licenseInfo["product_name"]))
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                            >
                                <div class="mb-2 flex items-center space-x-2">
                                    <div class="h-2 w-2 rounded-full bg-purple-500"></div>
                                    <span class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                        Product
                                    </span>
                                </div>
                                <p class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $licenseInfo["product_name"] }}
                                </p>
                            </div>
                        @endif

                        {{-- State --}}
                        <div
                            class="rounded-lg border border-gray-200 bg-white p-4 dark:border-gray-800 dark:bg-gray-900/20"
                        >
                            <div class="mb-2 flex items-center space-x-2">
                                <div
                                    class="{{ $isActive ? "bg-success-500" : "bg-warning-500" }} h-2 w-2 rounded-full"
                                ></div>
                                <span class="text-xs font-medium uppercase tracking-wide text-gray-500">State</span>
                            </div>
                            <p class="text-sm font-semibold capitalize text-gray-900 dark:text-white">
                                {{ $licenseState->label() }}
                            </p>
                        </div>
                    </div>
                </x-filament::section>
            @endif
        </div>
    </x-filament-panels::page>
</div>
