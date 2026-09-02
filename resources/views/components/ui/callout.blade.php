@props([
    'variant' => 'danger',
    'heading' => null,
    'icon' => 'alert',
])

<div {{ $attributes->class("alert alert-{$variant} d-flex align-items-start gap-2 mb-0") }} role="alert">
    @if ($icon)
        <x-icon :name="$icon" class="mt-1" />
    @endif

    <div>
        @if ($heading)
            <div class="fw-semibold">{{ $heading }}</div>
        @endif

        {{ $slot }}
    </div>
</div>
