<a {{ $attributes->class('d-inline-flex align-items-center gap-2 text-decoration-none text-body') }}>
    <span class="d-inline-flex align-items-center justify-content-center rounded bg-primary text-white" style="width: 2rem; height: 2rem">
        <x-app-logo-icon style="width: 1.15rem; height: 1.15rem" />
    </span>

    <span class="fw-semibold">{{ config('app.name', 'Laravel') }}</span>
</a>
