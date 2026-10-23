@php
    $statePath   = $getStatePath();
    $options     = $field->getOptions();
    $placeholder = $field->getSearchPlaceholder();
@endphp
<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div
        x-data="{
            state: $wire.{{ $applyStateBindingModifiers("\$entangle('{$statePath}')") }},
            search: '',
            groups: @js($options),

            get filtered() {
                if (!this.search.trim()) return this.groups;
                const q = this.search.toLowerCase();
                const result = {};
                Object.entries(this.groups).forEach(([group, gateways]) => {
                    const matched = Object.fromEntries(
                        Object.entries(gateways).filter(([id, gw]) =>
                            gw.name.toLowerCase().includes(q)
                        )
                    );
                    if (Object.keys(matched).length) result[group] = matched;
                });
                return result;
            },
        }"
        class="fi-fo-gateway-picker flex flex-col gap-3"
    >
        <x-filament::input.wrapper>
            <x-filament::input type="text" x-model="search" :placeholder="$placeholder" />
        </x-filament::input.wrapper>

        <div
            class="overflow-y-auto rounded-xl border border-gray-200 dark:border-white/10 pb-4"
            style="max-height: calc(100vh - 16rem)"
        >
            <div class="space-y-4 p-3">
                <template x-for="[group, gateways] in Object.entries(filtered)" :key="group">
                    <div class="space-y-2">
                        <p x-text="group" class="text-sm font-medium text-gray-500 dark:text-gray-400"></p>

                        <div class="grid grid-cols-3 gap-2 sm:grid-cols-4 lg:grid-cols-6">
                            <template x-for="[id, gw] in Object.entries(gateways)" :key="id">
                                <button
                                    type="button"
                                    @click="state = state === id ? null : id"
                                    :class="state === id
                                        ? 'border-primary-500 dark:border-primary-400 bg-primary-50 dark:bg-primary-500/10'
                                        : 'border-gray-200 dark:border-white/10 hover:border-gray-300 dark:hover:border-white/20 bg-white dark:bg-white/5'"
                                    class="relative flex w-full flex-col items-center gap-2 rounded-xl border p-2 text-center outline-none transition duration-75 focus-visible:ring-2 focus-visible:ring-primary-500"
                                >
                                    <template x-if="gw.logo">
                                        <div
                                            class="flex h-12 w-full items-center justify-center rounded-lg bg-white px-2 py-1.5"
                                        >
                                            <img
                                                :src="gw.logo"
                                                :alt="gw.name"
                                                class="h-8 w-auto max-w-16 object-contain"
                                            />
                                        </div>
                                    </template>

                                    <template x-if="!gw.logo">
                                        <div
                                            class="flex h-12 w-full items-center justify-center rounded-lg bg-gray-100 dark:bg-white/10"
                                        >
                                            <span
                                                x-text="gw.name.charAt(0).toUpperCase()"
                                                class="text-sm font-semibold text-gray-500 dark:text-gray-400"
                                            ></span>
                                        </div>
                                    </template>

                                    <span
                                        x-text="gw.name"
                                        class="line-clamp-2 text-xs font-medium leading-tight text-gray-700 dark:text-gray-300"
                                    ></span>

                                    <span
                                        x-show="state === id"
                                        x-transition:enter="transition duration-75"
                                        x-transition:enter-start="scale-75 opacity-0"
                                        x-transition:enter-end="scale-100 opacity-100"
                                        class="absolute right-1.5 top-1.5 flex h-4 w-4 items-center justify-center rounded-full bg-primary-500"
                                    >
                                        <svg class="h-2.5 w-2.5 text-white" viewBox="0 0 12 12" fill="none">
                                            <path d="M2 6l3 3 5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </span>
                                </button>
                            </template>
                        </div>
                    </div>
                </template>

                <div x-show="Object.keys(filtered).length === 0" class="py-6 text-center">
                    <p class="text-sm text-gray-400 dark:text-gray-500">{{ __('No gateways found.') }}</p>
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>
