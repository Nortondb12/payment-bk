@extends ("layouts.app")

@push ("style")
    <style>
        {{ $themeSettings->checkout_css }}
    </style>
@endpush

@section ("content")
    <!-- Full Design -->
    <div
        class="up-container relative mx-auto max-w-md overflow-hidden p-8 sm:flex sm:min-w-[650px] sm:flex-wrap sm:rounded-lg sm:bg-white sm:shadow-lg sm:shadow-[#0057d0]/10"
    >
        <!-- Nav -->
        <div
            class="flex h-12 w-full items-center justify-between overflow-hidden rounded-lg bg-white p-5 shadow-md shadow-[#0057d0]/5 sm:bg-[#fbfcff] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10"
        >
            <div class=""></div>
            <div class="flex items-end">
                <a href="{{ $cancelUrl }}">
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
        <!--END Nav -->

        <!-- Profile -->
        <div class="mt-7 mb-6 flex w-full flex-col items-center sm:mb-3 sm:flex-row">
            <div class="mb-4 sm:mr-8">
                <img
                    src="{{ app_round_logo() }}"
                    alt="{{ app_name() }}"
                    class="w-24 cursor-pointer overflow-hidden rounded-full object-cover ring-1 transition-all duration-300 hover:scale-105 sm:w-[85px]"
                />
            </div>
            <div class="flex flex-col items-center sm:items-start">
                <div class="mb-4 sm:mb-3">
                    <h3 class="text-xl font-semibold text-[#6D7F9A]">{{ app_name() }}</h3>
                </div>
                <div class="flex">
                    <a
                        href="#"
                        data-tab="supportSection"
                        id="supportSectionup"
                        class="up-nav-tab2 section-btn active-profile"
                    >
                        <svg width="22" viewBox="0 0 24 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.8 9.8C20.8 7.46609 19.8728 5.22778 18.2225 3.57746C16.5722 1.92714 14.3339 1 12 1C9.66605 1 7.42773 1.92714 5.77741 3.57746C4.12709 5.22778 3.19995 7.46609 3.19995 9.8"
                                stroke="#6D7F9A"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></path>
                            <path
                                d="M20.8 17.5V18.05C20.8 18.6335 20.5682 19.1931 20.1556 19.6056C19.7431 20.0182 19.1835 20.25 18.6 20.25H14.75M1 14.6818V12.6182C1.00007 12.1276 1.16412 11.6511 1.46608 11.2645C1.76803 10.8778 2.19055 10.6032 2.6665 10.4842L4.5805 10.0046C4.67776 9.98039 4.77926 9.97863 4.87729 9.99948C4.97533 10.0203 5.06733 10.0632 5.14631 10.1249C5.2253 10.1866 5.28919 10.2655 5.33315 10.3556C5.3771 10.4457 5.39996 10.5446 5.4 10.6448V16.6541C5.40017 16.7546 5.37742 16.8537 5.33347 16.944C5.28953 17.0343 5.22555 17.1134 5.14641 17.1753C5.06727 17.2371 4.97506 17.2801 4.8768 17.3009C4.77854 17.3217 4.67682 17.3198 4.5794 17.2954L2.6654 16.8169C2.18966 16.6977 1.76738 16.423 1.46564 16.0364C1.1639 15.6497 1.00001 15.1734 1 14.6829V14.6818ZM23 14.6818V12.6182C22.9999 12.1276 22.8359 11.6511 22.5339 11.2645C22.232 10.8778 21.8094 10.6032 21.3335 10.4842L19.4195 10.0046C19.3222 9.98039 19.2207 9.97863 19.1227 9.99948C19.0247 10.0203 18.9327 10.0632 18.8537 10.1249C18.7747 10.1866 18.7108 10.2655 18.6669 10.3556C18.6229 10.4457 18.6 10.5446 18.6 10.6448V16.6541C18.5999 16.7544 18.6226 16.8535 18.6665 16.9437C18.7104 17.0339 18.7742 17.1129 18.8533 17.1747C18.9323 17.2366 19.0243 17.2796 19.1224 17.3005C19.2206 17.3214 19.3222 17.3197 19.4195 17.2954L21.3335 16.8169C21.8094 16.6979 22.232 16.4233 22.5339 16.0366C22.8359 15.65 22.9999 15.1735 23 14.6829V14.6818Z"
                                stroke="#94A9C7"
                                stroke-width="1.5"
                            ></path>
                            <path
                                d="M13.65 21.9H10.35C9.91234 21.9 9.49266 21.7261 9.18322 21.4167C8.87379 21.1073 8.69995 20.6876 8.69995 20.25C8.69995 19.8124 8.87379 19.3927 9.18322 19.0833C9.49266 18.7738 9.91234 18.6 10.35 18.6H13.65C14.0876 18.6 14.5072 18.7738 14.8167 19.0833C15.1261 19.3927 15.3 19.8124 15.3 20.25C15.3 20.6876 15.1261 21.1073 14.8167 21.4167C14.5072 21.7261 14.0876 21.9 13.65 21.9Z"
                                stroke="#6D7F9A"
                                stroke-width="1.5"
                            ></path>
                        </svg>
                        <div class="">
                            <span class="ml-3 hidden text-[14px] text-[#879ab6] sm:block">
                                {{ __("checkout.home.support") }}
                            </span>
                        </div>
                    </a>
                    <a href="#" data-tab="faqSection" id="faqSectionup" class="up-nav-tab2 section-btn mx-5">
                        <svg width="22" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.5 1C9.4233 1 7.39323 1.61581 5.66652 2.76957C3.9398 3.92332 2.59399 5.5632 1.79927 7.48182C1.00455 9.40045 0.796615 11.5116 1.20176 13.5484C1.6069 15.5852 2.60693 17.4562 4.07538 18.9246C5.54383 20.3931 7.41475 21.3931 9.45155 21.7982C11.4884 22.2034 13.5996 21.9955 15.5182 21.2007C17.4368 20.406 19.0767 19.0602 20.2304 17.3335C21.3842 15.6068 22 13.5767 22 11.5C22 8.71523 20.8938 6.04451 18.9246 4.07538C16.9555 2.10625 14.2848 1 11.5 1Z"
                                stroke="#6D7F9A"
                                stroke-width="1.5"
                                stroke-miterlimit="10"
                            ></path>
                            <path
                                d="M8.15918 8.29571C8.15918 8.29571 8.20929 7.25167 9.32671 6.35261C9.98952 5.81866 10.7842 5.66415 11.5001 5.65341C12.1522 5.64505 12.7344 5.75304 13.0828 5.91889C13.6794 6.20287 14.841 6.8961 14.841 8.37028C14.841 9.92142 13.8268 10.626 12.6712 11.401C11.5156 12.1759 11.2018 13.0171 11.2018 13.8864"
                                stroke="#94A9C7"
                                stroke-width="1.5"
                                stroke-miterlimit="10"
                                stroke-linecap="round"
                            ></path>
                            <path
                                d="M11.1422 18.1818C11.8011 18.1818 12.3353 17.6476 12.3353 16.9887C12.3353 16.3297 11.8011 15.7955 11.1422 15.7955C10.4832 15.7955 9.94897 16.3297 9.94897 16.9887C9.94897 17.6476 10.4832 18.1818 11.1422 18.1818Z"
                                fill="#A1B3CE"
                            ></path>
                        </svg>
                        <div class="">
                            <span class="ml-3 hidden text-[14px] text-[#879ab6] sm:block">
                                {{ __("checkout.home.faq") }}
                            </span>
                        </div>
                    </a>
                    <a
                        href="#"
                        data-tab="transactionsSection"
                        id="transactionsSectionup"
                        class="up-nav-tab2 section-btn"
                    >
                        <svg width="22" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.5 1C5.7016 1 1 5.7016 1 11.5C1 17.2984 5.7016 22 11.5 22C17.2984 22 22 17.2984 22 11.5C22 5.7016 17.2984 1 11.5 1Z"
                                stroke="#6D7F9A"
                                stroke-width="1.5"
                                stroke-miterlimit="10"
                            ></path>
                            <path
                                d="M10 10H12V17"
                                stroke="#94A9C7"
                                stroke-width="1.5"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            ></path>
                            <path
                                d="M9 17H14"
                                stroke="#94A9C7"
                                stroke-width="1.5"
                                stroke-miterlimit="10"
                                stroke-linecap="round"
                            ></path>
                            <path
                                d="M11.5 5C11.2033 5 10.9133 5.08797 10.6666 5.2528C10.42 5.41762 10.2277 5.65189 10.1142 5.92597C10.0006 6.20006 9.97095 6.50166 10.0288 6.79263C10.0867 7.08361 10.2296 7.35088 10.4393 7.56066C10.6491 7.77044 10.9164 7.9133 11.2074 7.97118C11.4983 8.02906 11.7999 7.99935 12.074 7.88582C12.3481 7.77229 12.5824 7.58003 12.7472 7.33335C12.912 7.08668 13 6.79667 13 6.5C13 6.10218 12.842 5.72064 12.5607 5.43934C12.2794 5.15803 11.8978 5 11.5 5Z"
                                fill="#94A9C7"
                            ></path>
                        </svg>
                        <div class="">
                            <span class="ml-3 hidden text-[14px] text-[#879ab6] sm:block">
                                {{ __("checkout.home.details") }}
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- END Profile -->

        <!-- BTN-->
        <div class="brand-nav flex w-full justify-between overflow-hidden rounded-md text-white">
            @if ($themeSettings->gateway_display_mode === "all")
                <x-checkout.nav-tab tab="all" :active="true">
                    {{ __("checkout.home.select_payment_method") }}
                </x-checkout.nav-tab>
            @else
                @if ($hasMfs)
                    <x-checkout.nav-tab tab="mfs" :active="true">
                        {{ $isSingleCategory ? __("checkout.home.select_payment_method") : __("checkout.home.mobile_banking") }}
                    </x-checkout.nav-tab>
                @endif
                @if ($hasGlobal)
                    <x-checkout.nav-tab tab="global" :active="!$hasMfs">
                        {{ $isSingleCategory ? __("checkout.home.select_payment_method") : __("checkout.home.global") }}
                    </x-checkout.nav-tab>
                @endif
                @if ($hasBank)
                    <x-checkout.nav-tab tab="bank_transfer" :active="!$hasMfs && !$hasGlobal">
                        {{ $isSingleCategory ? __("checkout.home.select_payment_method") : __("checkout.home.bank_transfer") }}
                    </x-checkout.nav-tab>
                @endif
            @endif
        </div>
        <!-- END BTN-->

        <!-- Main Section -->
        <div class="mt-3 w-full overflow-auto p-0.5 pb-7 sm:pb-0">
            @if ($themeSettings->gateway_display_mode === "all")
                <x-checkout.gateway-grid id="mfs" :gateways="$gateways" :active="true" />
            @else
                @if ($hasMfs)
                    <x-checkout.gateway-grid id="mfs" :gateways="$mfsGateways" :active="true" />
                @endif
                @if ($hasGlobal)
                    <x-checkout.gateway-grid id="global" :gateways="$globalGateways" :active="!$hasMfs" />
                @endif
                @if ($hasBank)
                    <x-checkout.gateway-grid
                        id="bank_transfer"
                        :gateways="$bankGateways"
                        :active="!$hasMfs && !$hasGlobal"
                    />
                @endif
            @endif
            <!-- Support Section -->
            <div id="supportSection" class="up-tab">
                <div class="flex flex-col justify-between sm:flex-row sm:flex-wrap">
                    @if (! blank($brandSettings->support_number))
                        <a
                            href="{{ __("checkout.support.phone_number", ["phone_number" => $brandSettings->support_number]) }}"
                            class="mb-4 w-full sm:w-[48%]"
                        >
                            <div class="support-div">
                                <img
                                    src="{{ theme_asset("assets/images/icon/phone-call.png") }}"
                                    alt="{{ __("checkout.support.number") }}"
                                    class="mr-3 w-7"
                                />
                                <span class="text-sm text-[#485263]">{{ __("checkout.support.number_details") }}</span>
                            </div>
                        </a>
                    @endif

                    @if (! blank($brandSettings->messenger_link))
                        <a
                            href="{{ __("checkout.support.messenger_link", ["messenger_link" => $brandSettings->messenger_link]) }}"
                            target="_Blank"
                            class="mb-4 w-full sm:w-[48%]"
                        >
                            <div class="support-div">
                                <img
                                    src="{{ theme_asset("assets/images/icon/messenger.png") }}"
                                    alt="{{ __("checkout.support.messenger") }}"
                                    class="mr-3 w-7"
                                />
                                <span class="text-sm text-[#485263]">
                                    {{ __("checkout.support.messenger_details") }}
                                </span>
                            </div>
                        </a>
                    @endif

                    @if (! blank($brandSettings->whatsapp_number))
                        <a
                            href="{{ __("checkout.support.whatsapp_number", ["whatsapp_number" => $brandSettings->whatsapp_number]) }}"
                            target="_blank"
                            class="mb-4 w-full sm:w-[48%]"
                        >
                            <div class="support-div">
                                <img
                                    src="{{ theme_asset("assets/images/icon/whatsapp.png") }}"
                                    alt="{{ __("checkout.support.whatsapp") }}"
                                    class="mr-3 w-7"
                                />
                                <span class="text-sm text-[#485263]">
                                    {{ __("checkout.support.whatsapp_details") }}
                                </span>
                            </div>
                        </a>
                    @endif

                    @if (! blank($brandSettings->email_address))
                        <a
                            href="{{ __("checkout.support.support_mail", ["support_mail" => $brandSettings->email_address]) }}"
                            target="_blank"
                            class="mb-4 w-full sm:w-[48%]"
                        >
                            <div class="support-div">
                                <img
                                    src="{{ theme_asset("assets/images/icon/email.png") }}"
                                    alt="{{ __("checkout.support.support_email") }}"
                                    class="mr-3 w-7"
                                />
                                <span class="text-sm text-[#485263]">{{ __("checkout.support.email_details") }}</span>
                            </div>
                        </a>
                    @endif

                    @if (! blank($brandSettings->telegram_link))
                        <a
                            href="{{ __("checkout.support.telegram_link", ["telegram_link" => $brandSettings->telegram_link]) }}"
                            target="_blank"
                            class="mb-4 w-full sm:w-[48%]"
                        >
                            <div class="support-div">
                                <img
                                    src="{{ theme_asset("assets/images/icon/telegram.png") }}"
                                    alt="{{ __("checkout.support.telegram") }}"
                                    class="mr-3 w-7"
                                />
                                <span class="text-sm text-[#485263]">
                                    {{ __("checkout.support.telegram_details") }}
                                </span>
                            </div>
                        </a>
                    @endif

                    @if (! blank($brandSettings->support_link))
                        <a
                            href="{{ __("checkout.support.support_link", ["support_link" => $brandSettings->support_link]) }}"
                            target="_blank"
                            class="mb-4 w-full sm:w-[48%]"
                        >
                            <div class="support-div">
                                <img
                                    src="{{ theme_asset("assets/images/icon/support.png") }}"
                                    alt="{{ __("checkout.support.support_ticket") }}"
                                    class="mr-3 w-7"
                                />
                                <span class="text-sm text-[#485263]">
                                    {{ __("checkout.support.support_ticket_details") }}
                                </span>
                            </div>
                        </a>
                    @endif
                </div>
            </div>
            <!-- END Support Section -->

            <!-- FAQ Section -->
            <div id="faqSection" class="up-tab">
                <div class="flex flex-col py-2">
                    @foreach ($faqs as $faq)
                        <div
                            class="mb-4 flex flex-col overflow-hidden rounded-md bg-white shadow-md shadow-[#0057d0]/5 focus:outline-none sm:bg-[#fbfcff] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10"
                        >
                            <div class="tab-accordian">
                                <div class="titleWrapper flex cursor-pointer justify-between px-5 py-4">
                                    <h3 class="w-[90%] text-left text-[15px] text-[#526075]">{{ $faq->title }}</h3>
                                    <svg
                                        class="w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                        fill="#6D7F9A"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>
                                </div>
                                <div id="descwrapper" class="desWrapper hidden max-h-[200px]">
                                    <p class="border-t border-[#6D7F9A]/10 px-5 py-3 text-sm text-[#6D7F9A]">
                                        {!! $faq->content !!}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- END FAQ Section -->

            <!-- Transaction Details -->
            <div id="transactionsSection" class="up-tab">
                <div class="rounded-lg bg-white shadow-md shadow-[#0057d0]/5">
                    <div
                        class="brand-text-color rounded-lg bg-[#e5efff] px-5 py-4 text-center font-semibold sm:bg-transparent sm:py-0"
                    >
                        <h2>{{ __("checkout.details.title") }}</h2>
                    </div>
                    <ul class="px-5 py-4 sm:mb-5">
                        <li class="flex justify-between text-sm font-semibold text-[#6D7F9A] sm:text-base">
                            <p>{{ __("checkout.details.name") }}</p>
                            <p>{{ $customerName }}</p>
                        </li>
                        <hr class="my-3 border-[#6D7F9A]/10 sm:my-1.5" />
                        <li class="flex justify-between text-sm font-semibold text-[#6D7F9A] sm:text-base">
                            <p>{{ __("checkout.details.email") }}</p>
                            <p>{{ $customerEmail }}</p>
                        </li>

                        <hr class="my-3 border-[#6D7F9A]/10 sm:my-1.5" />
                        <li class="flex justify-between text-sm text-[#6D7F9A]">
                            <p class="font-semibold">{{ __("checkout.details.amount") }}</p>
                            <p class="brand-text-color font-semibold">{{ $amountFormatted }}</p>
                        </li>
                        <hr class="my-3 border-[#6D7F9A]/10 sm:my-1.5" />
                        <li class="flex justify-between text-sm text-[#6D7F9A]">
                            <p>{{ __("checkout.details.fee") }}</p>
                            <p>{{ __("checkout.details.additional_fee") }}</p>
                        </li>
                        <hr class="my-3 border-[#6D7F9A]/10 sm:my-1.5" />
                        <li class="flex justify-between text-sm text-[#6D7F9A]">
                            <p class="font-semibold">{{ __("checkout.details.total_amount") }}</p>
                            <p class="brand-text-color font-semibold">{{ $amountFormatted }}</p>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END Transaction Details -->
        </div>
        <!-- END Main Section -->
        <div
            class="brand-footer-nav fixed bottom-0 left-0 w-full rounded-t-2xl py-[18px] text-center font-semibold backdrop-blur-sm sm:static sm:rounded-[10px] sm:px-4 sm:py-3.5"
        >
            {{ __("checkout.home.pay") }} {{ $amountFormatted }}
        </div>
    </div>
    <!-- END Full Design -->
@endsection

@push ("script")
    <script type="module">
        $(document).ready(function () {
            // FAQ
            $(document).on("click", ".titleWrapper", function () {
                var toggle = $(this).next("div#descwrapper");
                $(toggle).slideToggle("slow");
            });

            $(document).on("click", ".inactive", function () {
                $(this).toggleClass("inactive active");
            });

            // Header Section
            $(document).on("click", "#supportSectionup", function () {
                $(this).addClass("active");
            });

            $(document).on("click", "#faqSectionup", function () {
                $(this).addClass("active");
            });

            $(document).on("click", "#transactionsSectionup", function () {
                $(this).addClass("active");
            });
        });
    </script>
    <script>
        function Tabs() {
            var bindAll = function () {
                var menuElements = document.querySelectorAll("[data-tab]");
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].addEventListener("click", change, false);
                }
            };

            var clear = function () {
                var menuElements = document.querySelectorAll("[data-tab]");
                for (var i = 0; i < menuElements.length; i++) {
                    menuElements[i].classList.remove("active");
                    var id = menuElements[i].getAttribute("data-tab");
                    var targetElement = document.getElementById(id);
                    if (targetElement) {
                        targetElement.classList.remove("active");
                    }
                }
            };

            var change = function (e) {
                e.preventDefault();
                clear();
                e.currentTarget.classList.add("active");
                var id = e.currentTarget.getAttribute("data-tab");
                var targetElement = document.getElementById(id);
                if (targetElement) {
                    targetElement.classList.add("active");
                }
            };

            bindAll();
        }

        document.addEventListener("DOMContentLoaded", function () {
            var connectTabs = new Tabs();
        });
    </script>
    <script>
        {!! $themeSettings->checkout_js !!};
    </script>
@endpush
