<div class="flex w-full flex-col">
    <h2 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white">
        {{ $data->name }}
        @if ($data->is_required)
            <small class="text-danger">*</small>
        @endif
    </h2>

    <select
        class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
        name="{{ $data->key }}"
        @if ($data->is_required) required @endif
    >
        <option value="">{{ __("form.options.select_one") }}</option>
        @foreach ($data->options as $item)
            <option value="{{ $item }}" @selected ($item == old($data->key))>{{ $item }}</option>
        @endforeach
    </select>
</div>
