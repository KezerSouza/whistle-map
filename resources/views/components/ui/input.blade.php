@props([
    'name' => null,
    'label' => null,
    'type' => 'text',
    'viewable' => false,
    'hint' => null,
])

@php
    $model = $attributes->whereStartsWith('wire:model')->first();
    $errorKey = $name ?? $model;
    $id = $attributes->get('id') ?? 'input-'.Str::slug($errorKey ?? $label ?? 'field');
    $hasError = $errorKey && $errors->has($errorKey);

    $inputAttributes = $attributes
        ->except(['id', 'class'])
        ->merge(['id' => $id, 'name' => $name, 'type' => $type])
        ->class(['form-control', 'is-invalid' => $hasError]);
@endphp

<div {{ $attributes->only('class') }}>
    @if ($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif

    @if ($viewable)
        <div class="input-group">
            <input {{ $inputAttributes }} />

            <button
                type="button"
                class="btn btn-outline-secondary"
                data-password-toggle
                aria-label="{{ __('Toggle password visibility') }}"
            >
                <x-icon name="eye" data-password-toggle-show />
                <x-icon name="eye-slash" class="d-none" data-password-toggle-hide />
            </button>
        </div>
    @else
        <input {{ $inputAttributes }} />
    @endif

    @if ($hint)
        <div class="form-text">{{ $hint }}</div>
    @endif

    @if ($hasError)
        <div class="invalid-feedback d-block">{{ $errors->first($errorKey) }}</div>
    @endif
</div>
