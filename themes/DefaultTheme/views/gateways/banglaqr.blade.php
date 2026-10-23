@extends ("layouts.app")

@push ("style")
    <style>
        {{ $themeSettings->gateway_css }}

        .banglaqr-qr {
            line-height: 0;
        }

        .banglaqr-qr svg {
            display: block;
            width: 100%;
            height: auto;
        }
    </style>
@endpush

@section ("content")
    <div
        class="up-container mx-auto max-w-md overflow-hidden p-8 sm:relative sm:flex sm:min-w-[650px] sm:flex-wrap sm:rounded-lg sm:bg-white sm:shadow-lg sm:shadow-[#0057d0]/10"
    >
        <!-- nav -->
        <div
            class="flex h-12 w-full items-center justify-between overflow-hidden rounded-lg bg-white p-5 shadow-md shadow-[#0057d0]/5 sm:bg-[#fbfcff] sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10"
        >
            <div>
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
                        <path d="M13 1L1 13" stroke="#94A9C7" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M1 1L13 13" stroke="#6D7F9A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </a>
            </div>
        </div>
        <!--END nav -->

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

            <div
                id="banglaqr"
                class="mt-3 overflow-auto rounded-lg bg-white p-5 sm:shadow-none sm:ring-1 sm:ring-[#0057d0]/10"
            >
                <h2 class="text-center text-lg font-bold text-primary">
                    {{ __("checkout.common.pay_with", ["name" => $gatewayName]) }}
                </h2>
                <p class="mb-4 text-center text-xs text-gray-400">{{ __("checkout.banglaqr.flow") }}</p>

                @if ($qrSvg)
                    <div class="mx-auto mb-4 w-full max-w-[280px] rounded-lg border border-[#0057d0]/10 p-3">
                        <div class="banglaqr-qr">{!! $qrSvg !!}</div>
                    </div>
                @endif

                @if ($gatewayDescription)
                    <div class="mb-4 rounded-md bg-[#e5efff] p-4 text-base leading-relaxed break-words text-[#0057d0]">
                        {{ $gatewayDescription }}
                    </div>
                @endif

                <div id="banglaqr-form">
                    <div
                        id="banglaqr-status-card"
                        class="mx-auto mt-2 mb-3 flex items-center justify-center gap-2.5 rounded-lg px-4 py-3 ring-1 {{ $isExpired ? 'bg-[#fff7ed] ring-amber-200' : 'bg-[#f4f8ff] ring-[#0057d0]/10' }}"
                    >
                        <span id="banglaqr-status-dot" class="relative flex h-2.5 w-2.5 shrink-0">
                            <span
                                class="absolute inline-flex h-full w-full animate-ping rounded-full bg-[#0057d0] opacity-60 {{ $isExpired ? 'hidden' : '' }}"
                            ></span>
                            <span
                                class="relative inline-flex h-2.5 w-2.5 rounded-full {{ $isExpired ? 'bg-amber-500' : 'bg-[#0057d0]' }}"
                            ></span>
                        </span>
                        <p
                            id="banglaqr-status"
                            class="text-sm font-medium {{ $isExpired ? 'text-amber-800' : 'text-[#0057d0]' }}"
                        >
                            {{ $isExpired ? __("checkout.common.expired") : __("checkout.common.waiting") }}
                        </p>
                        <span
                            id="banglaqr-elapsed"
                            class="text-xs text-gray-400 tabular-nums {{ $isExpired ? 'hidden' : '' }}"
                        >
                            00:00
                        </span>
                    </div>

                    @unless ($isExpired)
                        <div
                            id="banglaqr-do-not-close"
                            class="mb-4 rounded-md p-3 text-center text-sm font-medium"
                            style="background: #fff7ed; color: #9a3412"
                        >
                            {{ __("checkout.common.do_not_close") }}
                        </div>
                    @endunless
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    $banglaQrConfig = [
        "verifyUrl" => $verifyUrl,
        "csrfToken" => csrf_token(),
        "pollIntervalMs" => 10000,
        "isExpired" => $isExpired,
        "windowSecondsLeft" => max(0, $expiresAt->getTimestamp() - now()->getTimestamp()),
        "redirectDelayMs" => 1500,
        "messages" => [
            "verified" => __("checkout.common.verified"),
            "timeLeft" => __("checkout.common.time_left"),
        ],
    ];
@endphp

@push ("script")
    <script>
        const banglaQrConfig = @js ($banglaQrConfig);

        document.addEventListener("DOMContentLoaded", function () {
            const container = document.getElementById("banglaqr");
            if (!container) return;
            if (banglaQrConfig.isExpired) return;

            const { verifyUrl, csrfToken, pollIntervalMs, windowSecondsLeft, redirectDelayMs, messages } = banglaQrConfig;

            const statusElement = document.getElementById("banglaqr-status");
            const statusCard = document.getElementById("banglaqr-status-card");
            const statusDot = document.getElementById("banglaqr-status-dot");
            const elapsedElement = document.getElementById("banglaqr-elapsed");
            const doNotCloseElement = document.getElementById("banglaqr-do-not-close");

            const statusTones = {
                waiting: {
                    card: ["bg-[#f4f8ff]", "ring-[#0057d0]/10"],
                    text: ["text-[#0057d0]"],
                    dot: ["bg-[#0057d0]"]
                },
                attention: {
                    card: ["bg-[#fff7ed]", "ring-amber-200"],
                    text: ["text-amber-800"],
                    dot: ["bg-amber-500"]
                },
                verified: {
                    card: ["bg-[#f0fdf4]", "ring-green-200"],
                    text: ["text-green-700"],
                    dot: ["bg-green-500"]
                }
            };

            let isVerificationFinished = false;
            let isPolling = false;
            let isWindowExpired = false;

            const windowExpiresAt = Date.now() + windowSecondsLeft * 1000;

            function formatRemaining(totalSeconds) {
                const hours = Math.floor(totalSeconds / 3600);
                const minutes = Math.floor((totalSeconds % 3600) / 60);
                const seconds = totalSeconds % 60;

                let time;

                if (hours > 0) {
                    time = hours + "h " + minutes + "m";
                } else if (minutes > 0) {
                    time = minutes + "m " + seconds + "s";
                } else {
                    time = seconds + "s";
                }

                return messages.timeLeft.replace(":time", time);
            }

            const countdownTimer = setInterval(function () {
                if (isVerificationFinished) {
                    clearInterval(countdownTimer);
                    return;
                }

                const secondsLeft = Math.max(0, Math.floor((windowExpiresAt - Date.now()) / 1000));
                elapsedElement.textContent = formatRemaining(secondsLeft);

                if (secondsLeft === 0) {
                    clearInterval(countdownTimer);
                    if (!isWindowExpired) {
                        pollVerification();
                    }
                }
            }, 1000);

            elapsedElement.textContent = formatRemaining(Math.max(0, windowSecondsLeft));

            function setStatusTone(tone) {
                Object.values(statusTones).forEach(function (current) {
                    statusCard.classList.remove(...current.card);
                    statusElement.classList.remove(...current.text);
                    statusDot.querySelectorAll("span").forEach(function (dot) {
                        dot.classList.remove(...current.dot);
                    });
                });

                statusCard.classList.add(...tone.card);
                statusElement.classList.add(...tone.text);
                statusDot.querySelectorAll("span").forEach(function (dot) {
                    dot.classList.add(...tone.dot);
                });
            }

            function redirectTo(url) {
                isVerificationFinished = true;
                setStatusTone(statusTones.verified);
                statusElement.textContent = messages.verified;
                elapsedElement.classList.add("hidden");

                if (url) {
                    setTimeout(function () {
                        window.location.href = url;
                    }, redirectDelayMs);
                }
            }

            function showAttention(message) {
                statusElement.textContent = message;
                setStatusTone(statusTones.attention);
            }

            function handleStopped(message) {
                if (isWindowExpired) return;
                isWindowExpired = true;
                clearInterval(pollTimer);
                clearInterval(countdownTimer);
                doNotCloseElement.classList.add("hidden");
                showAttention(message);
            }

            async function pollVerification() {
                if (isVerificationFinished || isPolling || isWindowExpired) return;

                isPolling = true;

                try {
                    const response = await fetch(verifyUrl, {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "Accept": "application/json",
                            "X-CSRF-TOKEN": csrfToken
                        },
                        body: "{}"
                    });

                    const payload = await response.json();

                    if (payload.redirect_url) {
                        redirectTo(payload.redirect_url);
                        return;
                    }

                    if (!response.ok || payload.status === "error") {
                        handleStopped(payload.message);
                        return;
                    }

                    // Still waiting: the only answer left, so just report it.
                    statusElement.textContent = payload.message;
                } catch (error) {
                    // keep waiting; the next poll will retry
                } finally {
                    isPolling = false;
                }
            }

            const pollTimer = setInterval(pollVerification, pollIntervalMs);
        });
    </script>
    <script>
        {!! $themeSettings->gateway_js !!};
    </script>
@endpush
