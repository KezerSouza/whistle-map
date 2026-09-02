<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-vh-100 bg-body-tertiary">
        <div class="d-flex align-items-stretch min-vh-100">
            <aside class="app-sidebar app-sidebar-sticky d-none d-lg-flex flex-column border-end bg-body p-3">
                <div class="mb-4">
                    <x-app-logo href="{{ route('dashboard') }}" wire:navigate />
                </div>

                @include('partials.sidebar-nav')

                <div class="border-top pt-2 mt-2">
                    <x-desktop-user-menu />
                </div>
            </aside>

            <div class="flex-grow-1 min-width-0">
                <header class="d-lg-none border-bottom bg-body">
                    <div class="d-flex align-items-center gap-2 p-2">
                        <button
                            class="btn btn-outline-secondary"
                            type="button"
                            data-bs-toggle="offcanvas"
                            data-bs-target="#mobile-sidebar"
                            aria-controls="mobile-sidebar"
                            aria-label="{{ __('Toggle navigation') }}"
                        >
                            <x-icon name="menu" />
                        </button>

                        <x-app-logo href="{{ route('dashboard') }}" wire:navigate />

                        <div class="ms-auto">
                            <x-desktop-user-menu />
                        </div>
                    </div>
                </header>

                {{ $slot }}
            </div>
        </div>

        <div class="offcanvas offcanvas-start" tabindex="-1" id="mobile-sidebar" aria-label="{{ __('Navigation') }}">
            <div class="offcanvas-header border-bottom">
                <x-app-logo href="{{ route('dashboard') }}" wire:navigate />
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="{{ __('Close') }}"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column">
                @include('partials.sidebar-nav')
            </div>
        </div>

        <x-ui.toasts />
    </body>
</html>
