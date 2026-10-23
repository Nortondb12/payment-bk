@extends ("layouts.app")

@push ("style")
    <style>
        {{ $themeSettings->payment_link_css }}
    </style>
@endpush

@section ("content")
    <!-- Full Design -->
    <div
        class="up-container mx-auto max-w-md overflow-hidden p-8 sm:relative sm:min-w-[650px] sm:rounded-lg sm:bg-white sm:shadow-lg sm:shadow-[#0057d0]/10"
    >
        <div class="relative mb-5 flex w-full flex-col">
            <!-- Logo -->
            <div class="mb-5 flex justify-center">
                <img src="{{ app_logo() }}" alt="{{ app_name() }}" class="w-56 sm:w-48" />
            </div>
            <!-- END Logo -->
            <div class="mb-5 flex justify-center font-semibold">{{ $productName }}</div>
            <div class="mb-5 flex justify-center">{{ $productDescription }}</div>
        </div>
        <!-- form -->
        <form method="post" action="{{ $formActionUrl }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="currency" value="{{ $currency }}" autocomplete="off" />
            <div class="mb-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
                <div class="flex w-full flex-col">
                    <h2 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white">
                        {{ __("checkout.form.full_name") }}
                        <small class="text-danger">*</small>
                    </h2>
                    <input
                        type="text"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        name="name"
                        value="{{ old("name") }}"
                        placeholder="{{ __("checkout.form.full_name") }}"
                        required
                    />
                </div>
                <div class="flex w-full flex-col">
                    <h2 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white">
                        {{ __("checkout.form.email") }}
                        <small class="text-danger">*</small>
                    </h2>
                    <input
                        type="text"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        name="email"
                        value="{{ old("email") }}"
                        placeholder="{{ __("checkout.form.email") }}"
                        required
                    />
                </div>
                <div class="flex w-full flex-col">
                    <h2 class="mb-1 text-sm font-semibold text-gray-800 dark:text-white">
                        {{ __("checkout.form.phone") }}
                        <small class="text-danger">*</small>
                    </h2>
                    <input
                        type="text"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        name="phone"
                        value="{{ old("phone") }}"
                        placeholder="{{ __("checkout.form.phone") }}"
                        required
                    />
                </div>
                <x-forms.paymentlink :fields="$formFields" />
            </div>
            <div class="w-full">
                <button type="submit" class="w-full">
                    <div class="btn-primary w-full">{{ __("checkout.form.submit") }}</div>
                </button>
            </div>
        </form>
        <!-- END form -->
    </div>
    <!-- END Full Design -->
@endsection

@push ("script")
    <script>
        {!! $themeSettings->payment_link_js !!};
    </script>
@endpush
