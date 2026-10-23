@props ([
    "tab",
    "active" => false,
])
<a
    href="#"
    data-tab="{{ $tab }}"
    id="{{ $tab }}_btn"
    {{
        $attributes->class([
            "brand-nav-tab h-full w-[100%] rounded-md py-1.5 text-center text-[12px] leading-[23px] transition-all duration-300 sm:text-[15px]",
            "active" => $active,
        ])
    }}
>
    {{ $slot }}
</a>
