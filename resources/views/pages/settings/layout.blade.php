<div class="row g-4">
    <div class="col-md-3">
        <nav class="nav nav-pills flex-column gap-1" aria-label="{{ __('Settings') }}">
            <a class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : 'text-body' }}" href="{{ route('profile.edit') }}" wire:navigate>
                {{ __('Profile') }}
            </a>
            <a class="nav-link {{ request()->routeIs('security.edit') ? 'active' : 'text-body' }}" href="{{ route('security.edit') }}" wire:navigate>
                {{ __('Security') }}
            </a>
            <a class="nav-link {{ request()->routeIs('appearance.edit') ? 'active' : 'text-body' }}" href="{{ route('appearance.edit') }}" wire:navigate>
                {{ __('Appearance') }}
            </a>
        </nav>
    </div>

    <div class="col-md-9">
        <h2 class="h5 mb-1">{{ $heading ?? '' }}</h2>
        <p class="text-body-secondary">{{ $subheading ?? '' }}</p>

        <div class="mt-4" style="max-width: 32rem">
            {{ $slot }}
        </div>
    </div>
</div>
