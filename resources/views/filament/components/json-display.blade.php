@php
    $jsonString = $json ? json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : null;
    $copyId = "json-" . md5($jsonString ?? "");
@endphp

@if ($jsonString)
    <div class="space-y-2">
        {{-- Label --}}
        <div class="flex items-center justify-between">
            <label class="text-sm font-medium text-gray-950 dark:text-white">{{ $getLabel() ?? "JSON Data" }}</label>
            <button
                type="button"
                x-data="{
                    copyJson() {
                        const text = document.getElementById('{{ $copyId }}').textContent
                        navigator.clipboard.writeText(text).then(() => {
                            $tooltip('JSON copied!', { timeout: 1500 })
                        })
                    },
                }"
                @click="copyJson()"
                class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 flex items-center gap-1"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                    />
                </svg>
                Copy
            </button>
        </div>

        {{-- JSON Content --}}
        <pre
            id="{{ $copyId }}"
            class="bg-gray-900 dark:bg-gray-950 text-gray-100 p-4 rounded-lg overflow-x-auto text-xs font-mono whitespace-pre-wrap break-words"
            >{{ $jsonString }}</pre
        >
    </div>
@else
    <div class="space-y-2">
        <label class="text-sm font-medium text-gray-950 dark:text-white">{{ $getLabel() ?? "JSON Data" }}</label>
        <div class="text-sm text-gray-500 dark:text-gray-400">-</div>
    </div>
@endif
