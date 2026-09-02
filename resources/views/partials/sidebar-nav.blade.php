<nav class="d-flex flex-column h-100" aria-label="{{ __('Platform') }}">
    <div class="mb-3">
        <div class="text-uppercase text-body-secondary small fw-semibold px-2 mb-1">{{ __('Platform') }}</div>

        <ul class="nav nav-pills flex-column gap-1">
            <li class="nav-item">
                <a
                    class="nav-link d-flex align-items-center gap-2 {{ request()->routeIs('dashboard') ? 'active' : 'text-body' }}"
                    href="{{ route('dashboard') }}"
                    @if (request()->routeIs('dashboard')) aria-current="page" @endif
                    wire:navigate
                >
                    <x-icon name="grid" />
                    {{ __('Dashboard') }}
                </a>
            </li>
        </ul>
    </div>

    <ul class="nav nav-pills flex-column gap-1 mt-auto">
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 text-body" href="https://github.com/laravel/livewire-starter-kit" target="_blank" rel="noopener">
                <x-icon name="git" />
                {{ __('Repository') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link d-flex align-items-center gap-2 text-body" href="https://laravel.com/docs/starter-kits#livewire" target="_blank" rel="noopener">
                <x-icon name="book" />
                {{ __('Documentation') }}
            </a>
        </li>
    </ul>
</nav>
