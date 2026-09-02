@props([
    'variant' => 'default',
    'type' => 'button',
    'href' => null,
    'size' => null,
    'icon' => null,
])

@php
    $variants = [
        'primary' => 'btn-primary',
        'danger' => 'btn-danger',
        'filled' => 'btn-secondary',
        'outline' => 'btn-outline-secondary',
        'ghost' => 'btn-link text-decoration-none',
        'default' => 'btn-outline-secondary',
    ];

    $classes = collect([
        'btn',
        $variants[$variant] ?? $variants['default'],
        $size ? 'btn-'.$size : null,
        'd-inline-flex align-items-center justify-content-center gap-2',
    ])->filter()->implode(' ');
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->class($classes) }}>
        @if ($icon)
            <x-icon :name="$icon" />
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->class($classes) }}>
        @if ($icon)
            <x-icon :name="$icon" />
        @endif
        {{ $slot }}
    </button>
@endif
