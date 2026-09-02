@props([
    'name' => 'code',
    'label' => null,
    'length' => 6,
])

@php
    $id = $attributes->get('id') ?? 'otp-'.Str::slug($name);
    $hasError = $errors->has($name);
@endphp

<div class="d-flex flex-column align-items-center gap-2">
    <label for="{{ $id }}" class="visually-hidden">{{ $label ?? __('One-time code') }}</label>

    <input
        {{ $attributes->except(['id', 'class'])->merge([
            'id' => $id,
            'name' => $name,
            'type' => 'text',
            'inputmode' => 'numeric',
            'autocomplete' => 'one-time-code',
            'maxlength' => $length,
            'pattern' => '[0-9]*',
        ])->class(['form-control form-control-lg text-center otp-input', 'is-invalid' => $hasError]) }}
    />

    @if ($hasError)
        <div class="invalid-feedback d-block text-center">{{ $errors->first($name) }}</div>
    @endif
</div>
