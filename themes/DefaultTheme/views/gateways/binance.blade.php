@extends ("layouts.app")

@push ("style")
    <style>
        {{ $themeSettings->gateway_css }}
    </style>
@endpush

@section ("content")
    <!-- Full Design -->
    <div
        class="up-container mx-auto max-w-md overflow-hidden p-8 sm:relative sm:flex sm:min-w-[650px] sm:flex-wrap sm:rounded-lg sm:bg-white sm:shadow-lg sm:shadow-[#0057d0]/10"
    >
        <!-- nav -->
        <div
            class="flex h-12 w-full items-center justify-between overflow-hidden rounded-lg bg-white p-5 shadow-md shadow-[#0057d0]/5 sm:bg-[#fbfcff] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10"
        >
            <div class="">
                <a href="{{ $gatewayHomeUrl }}">
                    <svg width="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9.5 1C4.80558 1 1 4.80558 1 9.5C1 14.1944 4.80558 18 9.5 18C14.1944 18 18 14.1944 18 9.5C18 4.80558 14.1944 1 9.5 1Z"
                            stroke="#6D7F9A"
                            stroke-width="1.5"
                        ></path>
                        <path
                            d="M10.7749 12.9L7.3749 9.50002L10.7749 6.10002"
                            stroke="#94A9C7"
                            stroke-width="1.5"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </a>
            </div>
            <div class="flex items-center">
                <a href="{{ $gatewayCancelUrl }}">
                    <svg width="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13 1L1 13"
                            stroke="#94A9C7"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                        <path
                            d="M1 1L13 13"
                            stroke="#6D7F9A"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        ></path>
                    </svg>
                </a>
            </div>
        </div>
        <!--END nav -->

        <!-- Transaction -->
        <div class="w-full">
            <div class="flex flex-col flex-wrap sm:mt-5 sm:flex-row sm:items-center sm:justify-between">
                <div class="mb-4 flex h-20 w-full items-center justify-center sm:mt-0">
                    <img src="{{ $gatewayLogo }}" alt="GatewayLogo" class="h-[80%]" />
                </div>
                <div
                    class="flex items-center rounded-lg bg-white px-5 py-3 shadow shadow-[#0057d0]/5 sm:h-[85px] sm:w-[60%] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10"
                >
                    <div
                        class="mr-4 flex h-[55px] w-[55px] items-center justify-center rounded-full p-1.5 ring-1 ring-[#0057d0]/10"
                    >
                        <img src="{{ app_round_logo() }}" alt="{{ app_name() }}" class="w-[80%]" />
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-semibold text-[#6D7F9A]">{{ app_name() }}</h3>
                    </div>
                </div>
                <div
                    class="mt-3 flex flex-col rounded-lg bg-white p-4 shadow shadow-[#0057d0]/5 sm:mt-0 sm:h-[85px] sm:w-[35%] sm:items-center sm:justify-center sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10"
                >
                    <h1 class="text-xl font-semibold text-[#6D7F9A]">{{ $amountFormatted }}</h1>
                    @if ($hasDiscount)
                        <span class="mt-1 text-left text-xs font-medium text-green-600 sm:text-center">
                            {{ __("checkout.common.discount", ["amount" => $discountFormatted]) }}
                        </span>
                    @endif

                    @if ($hasFee)
                        <span class="mt-1 text-left text-xs font-medium text-red-600 sm:text-center">
                            {{ __("checkout.common.charge", ["amount" => $feeFormatted]) }}
                        </span>
                    @endif
                </div>
            </div>

            <form method="post" action="{{ $formActionUrl }}">
                @csrf
                <!-- Payment Page -->
                <div class="mt-3 overflow-auto rounded-lg bg-white p-5 sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
                    <div class="mb-5">
                        <ul class="text-gray-900">
                            <li class="flex text-sm">
                                <div>
                                    <span class="bank-info-span"></span>
                                </div>
                                <p>
                                    {!!
                                        __("checkout.binance.open_app", [
                                            "link" => '<a href="https://binance.com/my/wallet/account/payment/send" class="text-primary font-semibold" target="_blank">Click here<a>',
                                        ])
                                    !!}
                                </p>
                            </li>

                            @isset ($gatewayConfig['binance_id'])
                                <hr class="my-3" />
                                <li class="flex text-sm">
                                    <div>
                                        <span class="bank-info-span"></span>
                                    </div>
                                    <p class="">
                                        {!!
                                            __("checkout.binance.send_to", [
                                                "binance_id" => "<span class='text-primary font-semibold'>{$gatewayConfig['binance_id']}</span>",
                                            ])
                                        !!}
                                        <a
                                            class="brand-btn mx-2 inline-block cursor-pointer rounded-md px-2 py-0.5 text-slate-200"
                                            id="copy"
                                            id="copy"
                                            data-text="{{ $gatewayConfig['binance_id'] }}"
                                        >
                                            <img
                                                src="{{ theme_asset("assets/images/icon/copy.png") }}"
                                                class="mr-2 inline w-3"
                                                alt="{{ __("checkout.common.copy") }}"
                                            />
                                            {{ __("checkout.common.copy") }}
                                        </a>
                                    </p>
                                </li>
                            @endisset

                            <hr class="my-3" />
                            <li class="flex text-sm">
                                <div>
                                    <span class="bank-info-span"></span>
                                </div>
                                <p class="">
                                    {!!
                                        __("checkout.common.enter_amount", [
                                            "amount" => "<span class='text-primary font-semibold'>" . $amount . "</span>",
                                        ])
                                    !!}
                                    <a
                                        class="brand-btn mx-2 inline-block cursor-pointer rounded-md px-2 py-0.5 text-slate-200"
                                        id="copy"
                                        id="copy"
                                        data-text="{{ $amount }}"
                                    >
                                        <img
                                            src="{{ theme_asset("assets/images/icon/copy.png") }}"
                                            class="mr-2 inline w-3"
                                            alt="{{ __("checkout.common.copy") }}"
                                        />
                                        {{ __("checkout.common.copy") }}
                                    </a>
                                </p>
                            </li>
                            <hr class="my-3" />
                            <li class="flex text-sm">
                                <div>
                                    <span class="bank-info-span"></span>
                                </div>
                                <p>
                                    {!!
                                        __("checkout.common.confirm", [
                                            "method" => "<span class='text-primary font-semibold'>Name</span>",
                                        ])
                                    !!}
                                </p>
                            </li>
                            <hr class="my-3" />
                            <li class="flex text-sm">
                                <div>
                                    <span class="bank-info-span"></span>
                                </div>
                                <p>
                                    {!!
                                        __("checkout.binance.enter_order_id_instruction", [
                                            "order_id" => "<span class='text-primary font-semibold'>Order ID</span>",
                                            "verify" => "<span class='text-primary font-semibold'>Verify</span>",
                                        ])
                                    !!}
                                </p>
                            </li>
                            <hr class="my-3" />
                            <li class="flex text-sm">
                                <div>
                                    <span class="bank-info-span"></span>
                                </div>
                                <p>
                                    {!!
                                        __("checkout.common.note", [
                                            "minutes" => $gatewayConfig['payment_timeout'] ?? 15,
                                        ])
                                    !!}
                                </p>
                            </li>
                        </ul>
                    </div>
                    <h2 class="mb-2 block text-sm font-bold text-gray-800 dark:text-white">
                        {{ __("checkout.binance.order_id") }}
                    </h2>
                    <input
                        type="text"
                        class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500"
                        name="order_id"
                        placeholder="{{ __("checkout.binance.enter_order_id") }}"
                        value="{{ old("order_id") }}"
                        required
                    />
                </div>
                <!-- END Payment Page -->
                <div class="mt-5">
                    <button
                        type="submit"
                        id="form_submit"
                        class="brand-btn block w-full rounded-[10px] px-4 py-3.5 text-center font-semibold text-white transition-colors"
                    >
                        {{ __("checkout.common.verify") }}
                    </button>
                </div>
            </form>
        </div>
        <!--END Transaction -->
    </div>
    <!-- END Full Design -->
@endsection

@push ("script")
    @include ("partials.copy")
    <script type="module">
        $(document).ready(function () {
            $("form").submit(function () {
                if (this.checkValidity()) {
                    $("#page-overlay").show();
                }
            });
        });
    </script>
    <script>
        {!! $themeSettings->gateway_js !!};
    </script>
@endpush
