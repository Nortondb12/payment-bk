<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @php
            $theme = $themeSettings ?? null;
            $brand = $brandSettings ?? null;
        @endphp

    <title inertia>{{ $page["props"]["pageTitle"] ?? app_name() }}</title>

    <link rel="icon" href="{{ app_favicon() }}" />

    <meta name="description" content="{{ $brand?->seo_description }}" />
    <meta name="keywords" content="{{ $brand?->seo_keywords }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Baloo+Da+2:wght@400..800&family=Space+Grotesk:wght@300..700&display=swap"
        rel="stylesheet"
    />

    @vite (["src/css/app.css", "src/app.tsx"], "themes/nova")

    <style>
        :root {
            --color-primary: {{ $theme?->primary_color ?? "#275EFF" }};
            --color-primary-light: {{ $theme?->primary_light_color ?? "#92AEFF" }};
            --color-bg: {{ $theme?->background_color ?? "#EDF6FE" }};
            --color-text: {{ $theme?->text_color ?? "#0f172a" }};
            --color-text-muted: {{ $theme?->text_muted_color ?? "#64748b" }};
            --color-border: {{ $theme?->border_color ?? "#e2e8f0" }};
            --radius-btn: {{ $theme?->radius_btn ?? 16 }}px;
            --radius-card: {{ $theme?->radius_card ?? 12 }}px;
        }
    </style>

    @if ($theme?->global_css)
        <style>
            {!! $theme->global_css !!}
        </style>
    @endif

    @inertiaHead
</head>

<body>
    @inertia

    @if ($theme?->global_js)
        <script>
            {!! $theme->global_js !!};
        </script>
    @endif
</body>
</html>
