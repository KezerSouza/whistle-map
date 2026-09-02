@props([
    'name',
    'size' => '1em',
])

{{--
    Minimal inline icon set. Flux shipped Heroicons; since it was removed and no
    icon package is installed, the handful of icons the UI needs live here.
--}}
<svg
    {{ $attributes->merge(['class' => 'flex-shrink-0']) }}
    xmlns="http://www.w3.org/2000/svg"
    width="{{ $size }}"
    height="{{ $size }}"
    viewBox="0 0 16 16"
    fill="none"
    stroke="currentColor"
    stroke-width="1.5"
    stroke-linecap="round"
    stroke-linejoin="round"
    aria-hidden="true"
    focusable="false"
>
    @switch($name)
        @case('grid')
            <rect x="2" y="2" width="5" height="5" rx="1" />
            <rect x="9" y="2" width="5" height="5" rx="1" />
            <rect x="2" y="9" width="5" height="5" rx="1" />
            <rect x="9" y="9" width="5" height="5" rx="1" />
            @break

        @case('git')
            <circle cx="4" cy="3.5" r="1.75" />
            <circle cx="4" cy="12.5" r="1.75" />
            <circle cx="12" cy="7" r="1.75" />
            <path d="M4 5.25v5.5" />
            <path d="M10.25 7H8a2 2 0 0 0-2 2v1" />
            @break

        @case('book')
            <path d="M2.5 3.5A1 1 0 0 1 3.5 2.5H7a1.5 1.5 0 0 1 1 .4 1.5 1.5 0 0 1 1-.4h3.5a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H9a1.5 1.5 0 0 0-1 .4 1.5 1.5 0 0 0-1-.4H3.5a1 1 0 0 1-1-1Z" />
            <path d="M8 2.9v10" />
            @break

        @case('gear')
            <circle cx="8" cy="8" r="2.25" />
            <path d="M8 1.5v1.75M8 12.75v1.75M1.5 8h1.75M12.75 8h1.75M3.4 3.4l1.25 1.25M11.35 11.35l1.25 1.25M12.6 3.4l-1.25 1.25M4.65 11.35 3.4 12.6" />
            @break

        @case('logout')
            <path d="M6 13.5H3.5a1 1 0 0 1-1-1v-9a1 1 0 0 1 1-1H6" />
            <path d="M10.5 5.5 13 8l-2.5 2.5" />
            <path d="M13 8H6" />
            @break

        @case('chevron-down')
            <path d="M4 6.25 8 10.25l4-4" />
            @break

        @case('chevron-up-down')
            <path d="M4.5 6.5 8 3l3.5 3.5" />
            <path d="M4.5 9.5 8 13l3.5-3.5" />
            @break

        @case('lock')
            <rect x="3.5" y="7" width="9" height="6.5" rx="1.25" />
            <path d="M5.75 7V5.25a2.25 2.25 0 0 1 4.5 0V7" />
            @break

        @case('qr-code')
            <rect x="2.5" y="2.5" width="4" height="4" rx="0.75" />
            <rect x="9.5" y="2.5" width="4" height="4" rx="0.75" />
            <rect x="2.5" y="9.5" width="4" height="4" rx="0.75" />
            <path d="M9.5 9.5h1.5M13.5 9.5v1.5M9.5 13.5h1.5M13.5 13.5v-1.5" />
            @break

        @case('copy')
            <rect x="5.5" y="5.5" width="8" height="8" rx="1.25" />
            <path d="M10.5 3.5A1 1 0 0 0 9.5 2.5h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1" />
            @break

        @case('check')
            <path d="M3 8.5 6.25 11.75 13 5" />
            @break

        @case('eye')
            <path d="M1.5 8S4 3.75 8 3.75 14.5 8 14.5 8 12 12.25 8 12.25 1.5 8 1.5 8Z" />
            <circle cx="8" cy="8" r="1.75" />
            @break

        @case('eye-slash')
            <path d="M1.5 8S4 3.75 8 3.75c1 0 1.9.26 2.7.68M14.5 8s-1.1 1.87-3 3.06c-1 .63-2.15 1.19-3.5 1.19-.8 0-1.55-.16-2.24-.42" />
            <path d="M2.5 2.5l11 11" />
            @break

        @case('sun')
            <circle cx="8" cy="8" r="2.75" />
            <path d="M8 1.25v1.5M8 13.25v1.5M1.25 8h1.5M13.25 8h1.5M3.4 3.4l1.05 1.05M11.55 11.55l1.05 1.05M12.6 3.4l-1.05 1.05M4.45 11.55 3.4 12.6" />
            @break

        @case('moon')
            <path d="M13 10.2A5.5 5.5 0 0 1 5.8 3a5.5 5.5 0 1 0 7.2 7.2Z" />
            @break

        @case('desktop')
            <rect x="1.75" y="2.75" width="12.5" height="8.5" rx="1" />
            <path d="M6 13.75h4" />
            @break

        @case('menu')
            <path d="M2.5 5h11M2.5 11h11" />
            @break

        @case('search')
            <circle cx="7" cy="7" r="4.25" />
            <path d="M10.25 10.25 13.5 13.5" />
            @break

        @case('alert')
            <circle cx="8" cy="8" r="6.25" />
            <path d="M8 5v3.5M8 10.75v.25" />
            @break

        @case('mic')
            <rect x="6.25" y="1.75" width="3.5" height="7" rx="1.75" />
            <path d="M3.75 7.5a4.25 4.25 0 0 0 8.5 0" />
            <path d="M8 11.75v2.5" />
            @break

        @case('pin')
            <path d="M8 14.25s4.5-4.35 4.5-7.5a4.5 4.5 0 1 0-9 0c0 3.15 4.5 7.5 4.5 7.5Z" />
            <circle cx="8" cy="6.5" r="1.5" />
            @break
    @endswitch
</svg>
