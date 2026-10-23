<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Meta Tag -->
    <title>{{ $pageTitle }}</title>
    <meta name="title" content="{{ $pageTitle }}" />
    <link rel="icon" href="{{ app_favicon() }}" />
    <meta name="description" content="{{ $brandSettings->seo_description }}" />
    <meta name="keywords" content="{{ $brandSettings->seo_keywords }}" />

    <!-- Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ route("home") }}" />
    <meta property="og:title" content="{{ $pageTitle }}" />
    <meta property="og:description" content="{{ $brandSettings->seo_description }}" />
    <meta property="og:image" content="{{ get_file($brandSettings->fb_og_image) }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ route("home") }}" />
    <meta property="twitter:title" content="{{ $pageTitle }}" />
    <meta property="twitter:description" content="{{ $brandSettings->seo_description }}" />
    <meta property="twitter:image" content="{{ get_file($brandSettings->twitter_og_image) }}" />

    @if ($brandSettings->google_tag_manager_id)
        <!-- Google Tag Manager -->
        <script>
            (function (w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    "gtm.start": new Date().getTime(),
                    "event": "gtm.js"
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != "dataLayer" ? "&l=" + l : "";
                j.async = true;
                j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, "script", "dataLayer", "{{ $brandSettings->google_tag_manager_id }}");
        </script>
    @endif

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    />

    <link
        href="https://fonts.googleapis.com/css2?family=Baloo+Da+2:wght@400;500;600;700;800&family=Inter:wght@100;200;300;400&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet"
    />

    @vite (["css/app.css", "js/jquery.js", "js/toastr.js"], "themes/defaulttheme")

    @stack ("style-lib")

    <style type="text/css">
        * {
            font-family: "Ariel", sans-serif;
        }

        body {
            background: linear-gradient(350deg, #f4f9ff, #edf4ffc9), url("{{ theme_asset("assets/images/body.png") }}");
        }

        .brand-btn {
            --tw-bg-opacity: 1;
            color: {{ $themeSettings->button_text_color ?? "#fff" }};
            background-color: {{ $themeSettings->button_background_color ?? "#0057d0" }};
        }

        .brand-btn:hover {
            --tw-bg-opacity: 1;
            color: {{ $themeSettings->button_hover_text_color ?? "#fff" }};
            background-color: {{ $themeSettings->button_hover_background_color ?? "#0667ef" }};
        }

        .brand-nav {
            --tw-bg-opacity: 1;
            color: {{ $themeSettings->navigation_text_color ?? "#fff" }};
            background-color: {{ $themeSettings->navigation_background_color ?? "#0057d0" }};
        }

        .brand-nav-tab.active {
            color: {{ $themeSettings->navigation_active_tab_text_color ?? "#fff" }};
            background-color: {{ $themeSettings->navigation_active_tab_background_color ?? "#004cb7" }};
        }

        .brand-footer-nav {
            --tw-bg-opacity: 1;
            color: {{ $themeSettings->navigation_footer_text_color ?? "#0057D0" }};
            background-color: {{ $themeSettings->navigation_footer_background_color ?? "#cde1ff" }};
        }

        .brand-text-color {
            color: {{ $themeSettings->text_color ?? "#0057D0" }};
        }

        {{ $themeSettings->global_css }}
    </style>

    @stack ("style")
</head>

<body class="min-h-screen w-full sm:flex sm:h-auto sm:items-center sm:justify-center sm:p-12">
    @if ($brandSettings->google_tag_manager_id)
        <!-- Google Tag Manager (noscript) -->
        <noscript>
            <iframe
                src="https://www.googletagmanager.com/ns.html?id={{ $brandSettings->google_tag_manager_id }}"
                height="0"
                width="0"
                style="display: none; visibility: hidden"
            ></iframe>
        </noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endif

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

    @yield ("content")

    @stack ("script-lib")

    @include ("partials.notify")

    @stack ("script")

    {!! $themeSettings->global_js !!}
</body>
</html>
