<div class="flex flex-col items-center justify-center space-y-4 py-6">
    <div
        class="inline-block rounded-xl bg-white p-1 shadow-sm ring-1 ring-gray-900/5 dark:bg-gray-800 transition-all duration-200 hover:shadow-md"
    >
        <div class="p-4">{!! $qrCode !!}</div>
    </div>

    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
        <x-filament::icon icon="heroicon-m-qr-code" class="w-5 h-5" />
        <span>Scan to access payment link for {{ $currency }}</span>
    </div>
</div>
