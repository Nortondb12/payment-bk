<div>
    @if ($deployId && $status)
        @php
            $state = $status['status'] ?? 'pending';
            $terminal = $this->isTerminal();
            $success = $state === 'success';
        @endphp
        <div @if ($deploying && ! $terminal) wire:poll.3s="refreshStatus" @endif>
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center gap-2">
                        @if (! $terminal)
                            <x-heroicon-o-arrow-path class="text-primary-500 h-5 w-5 animate-spin" />
                            <span>Deploying Shopify app… {{ $progress }}%</span>
                        @elseif ($success)
                            <x-heroicon-o-check-circle class="text-success-500 h-5 w-5" />
                            <span>Deployment complete</span>
                        @else
                            <x-heroicon-o-x-circle class="text-danger-500 h-5 w-5" />
                            <span>Deployment failed</span>
                        @endif
                    </div>
                </x-slot>

                @if ($label)
                    <x-slot name="description">
                        {{ $label }}
                    </x-slot>
                @endif

                <div class="space-y-3">
                    @php
                        $width = $success ? 100 : $progress;
                        $barColor = $terminal ? ($success ? 'bg-success-500' : 'bg-danger-500') : 'bg-primary-500';
                    @endphp
                    <div class="h-2 w-full overflow-hidden rounded-full bg-gray-200 dark:bg-gray-700">
                        <div
                            class="h-2 rounded-full {{ $barColor }}"
                            style="width: {{ $width }}%; transition: width 2.8s linear;"
                        ></div>
                    </div>

                    <dl class="space-y-1 text-sm">
                        <div class="flex items-center justify-between gap-4">
                            <dt class="text-gray-500 dark:text-gray-400">Status</dt>
                            <dd class="font-medium capitalize">{{ $state }}</dd>
                        </div>

                        @if ($success && data_get($status, 'result.version'))
                            <div class="flex items-center justify-between gap-4">
                                <dt class="text-gray-500 dark:text-gray-400">Version</dt>
                                <dd class="font-medium">{{ data_get($status, 'result.version') }}</dd>
                            </div>
                        @endif

                        @if ($terminal && ! $success)
                            <p class="text-danger-600 dark:text-danger-400">Deployment could not be completed. Check the app client ID and automation token, then try again.</p>
                        @endif
                    </dl>

                    @if (data_get($status, 'result.url'))
                        <div>
                            <x-filament::button
                                tag="a"
                                :href="data_get($status, 'result.url')"
                                target="_blank"
                                icon="heroicon-o-arrow-top-right-on-square"
                                color="gray"
                                size="sm"
                            >
                                View Release
                            </x-filament::button>
                        </div>
                    @endif
                </div>
            </x-filament::section>
        </div>
    @endif
</div>
