@php
    $user = auth()->user();
    $id = 'user-menu-'.Str::random(6);
@endphp

<div {{ $attributes->class('dropdown') }}>
    <button
        class="btn btn-link text-decoration-none text-body d-flex align-items-center gap-2 w-100 px-2"
        type="button"
        id="{{ $id }}"
        data-bs-toggle="dropdown"
        aria-expanded="false"
        data-test="sidebar-menu-button"
    >
        <x-ui.avatar :name="$user->name" :initials="$user->initials()" />

        <span class="text-start lh-sm flex-grow-1 overflow-hidden">
            <span class="d-block text-truncate small fw-semibold">{{ $user->name }}</span>
            <span class="d-block text-truncate small text-body-secondary">{{ $user->email }}</span>
        </span>

        <x-icon name="chevron-up-down" />
    </button>

    <ul class="dropdown-menu w-100" aria-labelledby="{{ $id }}">
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}" wire:navigate>
                <x-icon name="gear" />
                {{ __('Settings') }}
            </a>
        </li>

        <li><hr class="dropdown-divider"></li>

        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="dropdown-item d-flex align-items-center gap-2" data-test="logout-button">
                    <x-icon name="logout" />
                    {{ __('Log out') }}
                </button>
            </form>
        </li>
    </ul>
</div>
