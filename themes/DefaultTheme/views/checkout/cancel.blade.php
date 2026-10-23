@extends ("layouts.app")

@section ("content")
    <!-- Full Design -->
    <div
        class="up-container relative mx-auto max-w-md overflow-hidden p-8 sm:relative sm:flex sm:min-w-[650px] sm:flex-wrap sm:rounded-lg sm:bg-white sm:shadow-lg sm:shadow-[#0057d0]/10"
    >
        <!-- Payment Cancelled -->
        <div class="relative w-full">
            <div class="sm:flex sm:justify-between">
                <div
                    class="mb-8 rounded-lg border border-[#bf2929]/20 bg-[#fffcfc] px-4 py-5 shadow-md shadow-[#bf2929]/5 sm:h-32 sm:w-[100%]"
                >
                    <div class="mb-3 flex items-center rounded-md bg-[#bf2929] px-4 py-3">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            version="1.1"
                            width="20"
                            height="20"
                            x="0"
                            y="0"
                            viewBox="0 0 512 512"
                            style="enable-background: new 0 0 512 512"
                            xml:space="preserve"
                        >
                            <g>
                                <g xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M256,0C114.615,0,0,114.615,0,256s114.615,256,256,256s256-114.615,256-256C511.847,114.678,397.322,0.153,256,0z    M341.333,311.189c8.669,7.979,9.229,21.475,1.25,30.144c-7.979,8.669-21.475,9.229-30.144,1.25c-0.434-0.399-0.85-0.816-1.25-1.25   L256,286.165l-55.168,55.168c-8.475,8.185-21.98,7.95-30.165-0.525c-7.984-8.267-7.984-21.373,0-29.64L225.835,256l-55.168-55.168   c-8.185-8.475-7.95-21.98,0.525-30.165c8.267-7.984,21.373-7.984,29.64,0L256,225.835l55.189-55.168   c7.979-8.669,21.475-9.229,30.144-1.25c8.669,7.979,9.229,21.475,1.25,30.144c-0.399,0.434-0.816,0.85-1.25,1.25L286.165,256   L341.333,311.189z"
                                        fill="#fff"
                                        data-original="#000000"
                                    ></path>
                                </g>
                            </g>
                        </svg>
                        <h3 class="ml-3 font-semibold text-[#ffdddd]">{{ __("checkout.complete.cancelled") }}</h3>
                    </div>
                    <p class="text-center text-sm text-[#6D7F9A]">{{ __("checkout.complete.cancel_thank_you") }}</p>
                </div>
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
        <!-- END Payment Cancelled -->
    </div>
@endsection
