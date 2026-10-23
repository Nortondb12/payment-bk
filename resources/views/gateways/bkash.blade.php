<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $pageTitle }}</title>
    <style>
        /*page-overlay*/
        #page-overlay {
            opacity: 0;
            top: 0px;
            left: 0px;
            position: fixed;
            background-color: rgba(249, 249, 249, 0.8);
            height: 100%;
            width: 100%;
            z-index: 9998;
            -webkit-transition: opacity 0.2s linear;
            -moz-transition: opacity 0.2s linear;
            transition: opacity 0.2s linear;
        }

        #page-overlay.visible {
            opacity: 1;
            display: none;
        }

        #page-overlay.hidden {
            opacity: 0;
            height: 0px;
            width: 0px;
            z-index: -10000;
        }

        #page-overlay .loader-wrapper-outer {
            background-color: transparent;
            z-index: 9999;
            margin: auto;
            width: 100%;
            height: 100%;
            overflow: hidden;
            display: table;
            text-align: center;
            vertical-align: middle;
        }

        #page-overlay .loader-wrapper-inner {
            display: table-cell;
            vertical-align: middle;
        }

        #page-overlay .loader {
            margin: auto;
        }

        @keyframes lds-double-ring {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @-webkit-keyframes lds-double-ring {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }

            100% {
                -webkit-transform: rotate(360deg);
                transform: rotate(360deg);
            }
        }

        @keyframes lds-double-ring_reverse {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }

            100% {
                -webkit-transform: rotate(-360deg);
                transform: rotate(-360deg);
            }
        }

        @-webkit-keyframes lds-double-ring_reverse {
            0% {
                -webkit-transform: rotate(0);
                transform: rotate(0);
            }

            100% {
                -webkit-transform: rotate(-360deg);
                transform: rotate(-360deg);
            }
        }

        #page-overlay .lds-double-ring {
            position: relative;
        }

        #page-overlay .lds-double-ring div {
            box-sizing: border-box;
        }

        #page-overlay .lds-double-ring > div {
            position: absolute;
            width: 44px;
            height: 44px;
            top: 78px;
            left: 78px;
            border-radius: 50%;
            border: 4px solid #000;
            border-color: #2196f3 transparent #2196f3 transparent;
            -webkit-animation: lds-double-ring 1s linear infinite;
            animation: lds-double-ring 1s linear infinite;
        }

        #page-overlay .lds-double-ring > div:nth-child(2),
        #page-overlay .lds-double-ring > div:nth-child(4) {
            width: 32px;
            height: 32px;
            top: 84px;
            left: 84px;
            -webkit-animation: lds-double-ring_reverse 1s linear infinite;
            animation: lds-double-ring_reverse 1s linear infinite;
        }

        #page-overlay .lds-double-ring > div:nth-child(2) {
            border-color: transparent #2196f3 transparent #2196f3;
        }

        #page-overlay .lds-double-ring > div:nth-child(3) {
            border-color: transparent;
        }

        #page-overlay .lds-double-ring > div:nth-child(3) div {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        #page-overlay .lds-double-ring > div:nth-child(3) div:before,
        #page-overlay .lds-double-ring > div:nth-child(3) div:after {
            content: "";
            display: block;
            position: absolute;
            width: 4px;
            height: 4px;
            top: -4px;
            left: 16px;
            background: #2196f3;
            border-radius: 50%;
            box-shadow: 0 40px 0 0 #2196f3;
        }

        #page-overlay .lds-double-ring > div:nth-child(3) div:after {
            left: -4px;
            top: 16px;
            box-shadow: 40px 0 0 0 #2196f3;
        }

        #page-overlay .lds-double-ring > div:nth-child(4) {
            border-color: transparent;
        }

        #page-overlay .lds-double-ring > div:nth-child(4) div {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-transform: rotate(45deg);
            transform: rotate(45deg);
        }

        #page-overlay .lds-double-ring > div:nth-child(4) div:before,
        #page-overlay .lds-double-ring > div:nth-child(4) div:after {
            content: "";
            display: block;
            position: absolute;
            width: 4px;
            height: 4px;
            top: -4px;
            left: 10px;
            background: #2196f3;
            border-radius: 50%;
            box-shadow: 0 28px 0 0 #2196f3;
        }

        #page-overlay .lds-double-ring > div:nth-child(4) div:after {
            left: -4px;
            top: 10px;
            box-shadow: 28px 0 0 0 #2196f3;
        }

        #page-overlay .lds-double-ring {
            width: 200px !important;
            height: 200px !important;
            display: inline-block;
            -webkit-transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
            transform: translate(-100px, -100px) scale(1) translate(100px, 100px);
        }

        /* Toastr Styles */
        .toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 10000;
            max-width: 300px;
        }

        .toast {
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            color: white;
            font-family: Arial, sans-serif;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            opacity: 0;
            transform: translateX(100%);
            transition: all 0.3s ease-in-out;
        }

        .toast.show {
            opacity: 1;
            transform: translateX(0);
        }

        .toast-success {
            background-color: #51a351;
        }

        .toast-warning {
            background-color: #f89406;
        }

        .toast-error {
            background-color: #bd362f;
        }

        .toast-info {
            background-color: #2f96b4;
        }

        .toast-close {
            float: right;
            font-weight: bold;
            color: white;
            font-size: 16px;
            cursor: pointer;
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <!-- Overlay Start-->
    <div id="page-overlay" class="incoming visible">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="lds-double-ring">
                    <div></div>
                    <div></div>
                    <div>
                        <div></div>
                    </div>
                    <div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Overlay End -->

    <!-- Toast Container -->
    <div class="toast-container"></div>

    <button style="display: none" id="bKash_button"></button>

    @if ($sandbox)
        <script src="https://scripts.sandbox.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout-sandbox.js"></script>
    @else
        <script src="https://scripts.pay.bka.sh/versions/1.2.0-beta/checkout/bKash-checkout.js"></script>
    @endif

    <script>
        // Simple jQuery-like selector
        function $(selector) {
            const element = document.querySelector(selector);
            if (!element) return null;

            return {
                click: function () {
                    element.click();
                },
                show: function () {
                    element.style.display = "block";
                },
                hide: function () {
                    element.style.display = "none";
                }
            };
        }

        // Toastr implementation
        const toastr = {
            success: function (message) {
                this.show(message, "success");
            },
            warning: function (message) {
                this.show(message, "warning");
            },
            error: function (message) {
                this.show(message, "error");
            },
            info: function (message) {
                this.show(message, "info");
            },
            show: function (message, type) {
                const container = document.querySelector(".toast-container");
                const toast = document.createElement("div");
                toast.className = `toast toast-${type}`;
                toast.innerHTML = `
                    <span class="toast-close">&times;</span>
                    ${message}
                `;

                container.appendChild(toast);

                // Show toast
                setTimeout(() => {
                    toast.classList.add("show");
                }, 10);

                // Auto hide after 5 seconds
                setTimeout(() => {
                    this.hide(toast);
                }, 5000);

                // Close button functionality
                toast.querySelector(".toast-close").onclick = () => {
                    this.hide(toast);
                };
            },
            hide: function (toast) {
                toast.classList.remove("show");
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.parentNode.removeChild(toast);
                    }
                }, 300);
            }
        };

        // Main script
        const params = {{ \Illuminate\Support\Js::from($response) }};
        const successUrl = "{{ $formActionUrl }}";
        const cancelUrl = "{{ $gatewayCancelUrl }}";
        const spinner = $("#page-overlay");
        spinner.show();

        bkashHandle(params, successUrl, cancelUrl);

        function bkashHandle(params) {
            bKash.init({
                paymentMode: "checkout",
                paymentRequest: {
                    amount: params.amount,
                    intent: params.intent
                },
                createRequest: function (request) {
                    if (typeof params === "object" && params !== null && params.hasOwnProperty("paymentID")) {
                        bKash.create().onSuccess(params);
                    } else {
                        bKash.create().onError();
                        toastr.warning("Invalid response from bKash API.");
                        setTimeout(function () {
                            location.href = cancelUrl;
                        }, 2000);
                    }
                },
                executeRequestOnAuthorization: function () {
                    toastr.success("Payment Successful");
                    location.href = successUrl;
                },
                onClose: function () {
                    toastr.warning("You did not completed the payment process.");
                    setTimeout(function () {
                        location.href = cancelUrl;
                    }, 2000);
                },
                onError: function () {
                    toastr.warning("Server Error");
                    setTimeout(function () {
                        location.href = cancelUrl;
                    }, 2000);
                }
            });

            $("#bKash_button").click();
        }
    </script>
</body>
</html>
