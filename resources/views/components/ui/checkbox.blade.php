@props([
    'name' => null,
    'label' => null,
    'checked' => false,
])

@php
    $id = $attributes->get('id') ?? 'checkbox-'.Str::slug($name ?? $label ?? 'field');
@endphp

<div class="form-check">
    <input
        {{ $attributes->except(['id', 'class'])->merge(['id' => $id, 'name' => $name, 'type' => 'checkbox', 'value' => '1'])->class('form-check-input') }}
        @checked($checked)
    />

    @if ($label)
        <label class="form-check-label" for="{{ $id }}">{{ $label }}</label>
    @endif
</div>
