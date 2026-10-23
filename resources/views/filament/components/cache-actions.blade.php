@php ($isCached = app()->configurationIsCached())

@if ($isCached)
    <form method="POST" action="{{ route("admin.cache.clear") }}" class="inline-flex">
        @csrf
        <x-filament::icon-button
            type="submit"
            icon="heroicon-o-bolt-slash"
            color="gray"
            tooltip="Clear Application Cache"
            label="Clear Application Cache"
        />
    </form>
@else
    <form method="POST" action="{{ route("admin.cache.optimize") }}" class="inline-flex">
        @csrf
        <x-filament::icon-button
            type="submit"
            icon="heroicon-o-bolt"
            color="primary"
            tooltip="Optimize Application"
            label="Optimize Application"
        />
    </form>
@endif
