@props([
    'status',
])

@if ($status)
    <div {{ $attributes->merge(['class' => 'alert alert-success mb-0 py-2 small']) }} role="status">
        {{ $status }}
    </div>
@endif
