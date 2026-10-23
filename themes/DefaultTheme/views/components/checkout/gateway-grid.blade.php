@props ([
    "id",
    "gateways",
    "active" => false,
])

<div id="{{ $id }}" @class (["up-tab", "active" => $active])>
    <div class="grid grid-cols-2 gap-3 pb-6 sm:grid-cols-3">
        @foreach ($gateways as $gateway)
            <a
                href="{{ $gateway->url }}"
                class="flex flex-col items-center overflow-hidden rounded-xl border border-[#E0E0E0] bg-[#ffffff] transition-shadow hover:shadow-lg hover:shadow-blue-900/5"
            >
                <div class="flex h-14 w-full items-center justify-center px-3 py-2">
                    <img
                        class="h-10 w-full object-contain"
                        src="{{ $gateway->logo }}"
                        alt="{{ $gateway->displayName }}"
                    />
                </div>
                <div class="w-full border-t px-3 py-2">
                    <p class="text-center text-xs font-light tracking-wide text-[#222222]">
                        {{ $gateway->displayName }}
                    </p>
                </div>
            </a>
        @endforeach
    </div>
</div>
