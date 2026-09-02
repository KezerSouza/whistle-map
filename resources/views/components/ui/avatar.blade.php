@props([
    'name' => null,
    'initials' => null,
])

<span
    {{ $attributes->class('avatar-initials bg-secondary-subtle text-secondary-emphasis') }}
    @if ($name) title="{{ $name }}" @endif
    aria-hidden="true"
>
    {{ $initials }}
</span>
