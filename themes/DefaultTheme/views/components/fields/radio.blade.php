<div class="flex w-full flex-col">
    <h2 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white">
        {{ $data->name }}
        @if ($data->is_required)
            <small class="text-danger">*</small>
        @endif
    </h2>

    <div class="mb-2 flex flex-wrap gap-1">
        @foreach ($data->options as $option)
            <div class="me-4 flex items-center">
                <input
                    class="h-4 w-4 border-gray-300 bg-gray-100 text-blue-600 focus:ring-2 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600"
                    name="{{ $data->key }}"
                    type="radio"
                    value="{{ $option }}"
                    @checked ($option == old($data->key))
                />
                <label class="ms-2 text-sm text-gray-900 dark:text-gray-300" for="{{ $data->key }}">
                    {{ $option }}
                </label>
            </div>
        @endforeach
    </div>
</div>
