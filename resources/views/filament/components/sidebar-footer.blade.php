<div class="fi-sidebar-group border-t border-gray-200 px-6 py-2 dark:border-white/10">
    <ul class="fi-sidebar-group-items -mx-2">
        @if (\App\Filament\Resources\MfsTransactions\MfsTransactionResource::canAccess())
            <x-filament-panels::sidebar.item
                :url="\App\Filament\Resources\MfsTransactions\Pages\ListMfsTransactions::getUrl()"
                icon="heroicon-o-server-stack"
                :active="str_starts_with(request()->url(), \App\Filament\Clusters\SmsData\SmsDataCluster::getUrl())"
            >
                SMS Data
            </x-filament-panels::sidebar.item>
        @endif

        @if (\App\Filament\Pages\SystemSettings::canAccess())
            <x-filament-panels::sidebar.item
                :url="\App\Filament\Pages\SystemSettings::getUrl()"
                icon="heroicon-o-cog-6-tooth"
                :active="str_starts_with(request()->url(), \App\Filament\Pages\SystemSettings::getUrl())
                    || request()->routeIs(\App\Filament\Resources\Activities\ActivityResource::getRouteBaseName().'*')"
            >
                System Settings
            </x-filament-panels::sidebar.item>
        @endif
    </ul>

    <div class="mt-1 flex items-center justify-between px-2 text-xs text-gray-500 dark:text-gray-400">
        <a
            href="https://docs.uddoktapay.com"
            target="_blank"
            rel="noopener"
            class="inline-flex items-center gap-1 transition hover:text-gray-700 dark:hover:text-gray-200"
        >
            <x-filament::icon icon="heroicon-m-book-open" class="size-3.5" />
            Docs
        </a>
        <span>V{{ config('app.version') }}</span>
    </div>
</div>
