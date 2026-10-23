<div class="flex w-full flex-col">
    <h2 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white">
        {{ $data->name }}
        @if ($data->is_required)
            <small class="text-danger">*</small>
        @endif
    </h2>

    <input
        class="mb-2 block w-full cursor-pointer rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-900 focus:outline-none dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400 dark:placeholder-gray-400"
        type="file"
        name="{{ $data->key }}"
        accept="@foreach ($data->extensions as $ext).{{ $ext }}, @endforeach"
        @if ($data->is_required) required @endif
    />
</div>
