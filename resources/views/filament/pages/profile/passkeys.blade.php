<div>
    <div>
        <form id="passkeyForm" wire:submit="validatePasskeyProperties" class="flex items-start space-x-2">
            <div class="w-full fi-fo-field">
                <x-filament::input.wrapper prefix="Name" :valid="! $errors->has('name')">
                    <x-filament::input type="text" wire:model="name" />
                </x-filament::input.wrapper>

                @error ("name")
                    <p class="fi-fo-field-wrp-error-message">{{ $message }}</p>
                @enderror
            </div>

            <x-filament::button type="submit">Create</x-filament::button>
        </form>
    </div>

    @if ($passkeys->isNotEmpty())
        <div class="mt-6">
            <span class="font-bold text-sm">Passkeys</span>
            <ul class="space-y-4">
                @foreach ($passkeys as $passkey)
                    <x-filament::fieldset class="mt-2">
                        <div class="flex items-center">
                            <div class="mr-2 flex flex-col">
                                <span>{{ $passkey->name }}</span>
                                <span class="text-xs fi-sc-text">
                                    Last used: {{ $passkey->last_used_at?->diffForHumans() ?? "Not used yet" }}
                                </span>
                            </div>

                            <div class="ml-auto">{{ ($this->deleteAction)(["passkey" => $passkey->id]) }}</div>
                        </div>
                    </x-filament::fieldset>
                @endforeach
            </ul>
        </div>
    @endif

    <x-filament-actions::modals />
</div>

@include ("passkeys::livewire.partials.createScript")
