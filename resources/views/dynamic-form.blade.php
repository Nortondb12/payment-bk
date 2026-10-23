<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Redirecting...</title>
    <script type="text/javascript">
        function closethisasap() {
            document.getElementById("dynamic-form").submit();
        }
    </script>
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
    </style>
</head>

<body onload="closethisasap()">
    <!-- Overlay Start-->
    <div id="page-overlay" class="incoming visible" style="display: block">
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
    <form action="{{ $action }}" method="post" id="dynamic-form">
        @foreach ($forms as $name => $value)
            <input type="hidden" name="{{ $name }}" value="{{ $value }}" />
        @endforeach
    </form>
</body>
</html>
