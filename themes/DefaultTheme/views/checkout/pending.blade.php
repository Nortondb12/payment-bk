@extends ("layouts.app")

@section ("content")
    <!-- Full Design -->
    <div
        class="up-container mx-auto max-w-md overflow-hidden p-8 sm:relative sm:flex sm:h-[430px] sm:min-w-[650px] sm:flex-wrap sm:rounded-lg sm:bg-white sm:shadow-lg sm:shadow-[#0057d0]/10"
    >
        <div class="bg-svg-effect absolute hidden sm:block">
            <svg width="100%" viewBox="0 0 280 262" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M6.46631 35.0198C29.4166 -13.8481 110.91 -6.9597 142.359 27.4081C173.809 61.7759 184.027 83.7973 212.402 70.9741C240.777 58.1509 276.937 61.5704 278.984 102.35C281.031 143.129 247.855 191.323 195.099 205.585C142.343 219.847 142.359 270.326 72.5387 260.141C34.4719 254.592 33.6005 213.402 38.9764 179.338C44.3523 145.275 -20.1501 91.6885 6.46631 35.0198Z"
                    fill="#F3F8FF"
                ></path>
            </svg>
        </div>
        <div class="w-full justify-between sm:flex">
            <!-- Congratulations -->
            <div class="sm:w-[42%]">
                <div class="flex flex-col items-center sm:items-start">
                    <h1 class="text-2xl font-semibold text-[#ff9100] sm:text-xl">{{ __("checkout.complete.oops") }}</h1>
                    <span class="fontse mb-2 text-xl text-[#6D7F9A] sm:text-base">
                        {{ __("checkout.complete.pending_thank_you") }}
                    </span>
                    <svg
                        width="130"
                        viewBox="0 0 126 15"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="sm:hidden"
                    >
                        <line
                            x1="1"
                            y1="8"
                            x2="49"
                            y2="8"
                            stroke="#6D7F9A"
                            stroke-width="2"
                            stroke-linecap="round"
                        ></line>
                        <line
                            x1="77"
                            y1="8"
                            x2="125"
                            y2="8"
                            stroke="#6D7F9A"
                            stroke-width="2"
                            stroke-linecap="round"
                        ></line>
                        <path
                            d="M62.1058 1.78577C62.4745 1.04941 63.5255 1.04941 63.8942 1.78578L65.2379 4.46942C65.3846 4.76228 65.6653 4.96476 65.9895 5.01147L68.9722 5.44126C69.7966 5.56004 70.123 6.57552 69.5222 7.15236L67.3838 9.20561C67.1439 9.436 67.0342 9.77062 67.0912 10.0983L67.5982 13.0121C67.74 13.8272 66.8872 14.4521 66.1527 14.0713L63.4603 12.6755C63.1717 12.5259 62.8283 12.5259 62.5397 12.6755L59.8473 14.0713C59.1128 14.4521 58.26 13.8272 58.4018 13.0122L58.9088 10.0983C58.9658 9.77062 58.8561 9.436 58.6162 9.20561L56.4778 7.15236C55.877 6.57552 56.2034 5.56004 57.0278 5.44126L60.0105 5.01147C60.3347 4.96476 60.6154 4.76227 60.7621 4.46942L62.1058 1.78577Z"
                            fill="#94A9C7"
                        ></path>
                    </svg>
                </div>
                <div class="mt-4 w-full overflow-hidden">
                    <img
                        src="{{ theme_asset("assets/images/pending.png") }}"
                        alt="Pending"
                        class="w-full scale-[0.8] object-cover sm:scale-90"
                    />
                </div>
            </div>
            <div class="sm:w-[56%]">
                <div class="mt-8 rounded-lg bg-white shadow-md shadow-[#0057d0]/5 sm:mt-0 sm:shadow-none">
                    <div class="brand-text-color rounded-lg bg-[#e5efff] px-5 py-4 text-center font-semibold sm:mb-1">
                        <h2>{{ __("checkout.complete.payment_info") }}</h2>
                    </div>
                    <ul class="px-5 py-4 sm:px-1">
                        <li class="flex justify-between text-sm font-semibold text-[#6D7F9A] sm:text-base">
                            <p>{{ __("checkout.complete.payment_method") }}</p>
                            <p>{{ $gatewayName }}</p>
                        </li>
                        <hr class="my-3 border-[#6D7F9A]/10" />

                        @if ($sender)
                            <li class="flex justify-between text-sm text-[#6D7F9A]">
                                <p>{{ __("checkout.complete.phone_number") }}</p>
                                <p>{{ $sender }}</p>
                            </li>
                            <hr class="my-3 border-[#6D7F9A]/10" />
                        @endif

                        @if ($transactionIdFormatted)
                            <li class="flex justify-between text-sm break-all text-[#6D7F9A]">
                                <p>{{ __("checkout.complete.transaction_id") }}</p>
                                <p>{{ $transactionIdFormatted }}</p>
                            </li>
                            <hr class="my-3 border-[#6D7F9A]/10" />
                        @endif

                        <li class="flex justify-between text-sm text-[#6D7F9A]">
                            <p>{{ __("checkout.complete.amount") }}</p>
                            <p>{{ $amountFormatted }}</p>
                        </li>
                        <hr class="my-3 border-[#6D7F9A]/10" />
                        <li class="flex justify-between text-sm text-[#6D7F9A]">
                            <p class="font-semibold">{{ __("checkout.complete.status") }}</p>
                            <p class="font-semibold text-orange-400">{{ $statusFormatted }}</p>
                        </li>
                    </ul>
                </div>
                {{--
                    <div class="w-full mt-5">
                    <a href="#"
                    class="flex justify-center items-center rounded-[10px] px-4 py-3 text-center bg-white text-[#94A9C7] hover:bg-[#e7f1ff] transition-colors shadow-md shadow-[#0057d0]/5 sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10">
                    <svg width="14" class="mr-2" viewBox="0 0 17 19" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18V10H11V18" stroke="#94A9C7" stroke-width="1.5" stroke-linecap="round"
                    stroke-linejoin="round"></path>
                    <path
                    d="M1 6.95L8.5 1L16 6.95V16.3C16 16.7509 15.8244 17.1833 15.5118 17.5021C15.1993 17.8209 14.7754 18 14.3333 18H2.66667C2.22464 18 1.80072 17.8209 1.48816 17.5021C1.17559 17.1833 1 16.7509 1 16.3V6.95Z"
                    stroke="#6D7F9A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    </path>
                    </svg>
                    {{ __('checkout.complete.return_to_website') }}
                    </a>
                    </div>
                --}}
            </div>
            <!-- END Congratulations -->
        </div>
    </div>
    <!-- END Full Design -->
@endsection
