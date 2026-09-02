<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head', ['title' => __('Welcome')])
    </head>
    <body class="min-vh-100 bg-body-tertiary d-flex flex-column">
        <header class="border-bottom bg-body">
            <nav class="container d-flex align-items-center py-3">
                <x-app-logo href="{{ route('home') }}" />

                @if (Route::has('login'))
                    <div class="ms-auto d-flex align-items-center gap-2">
                        @auth
                            <x-ui.button variant="primary" :href="route('dashboard')" wire:navigate>
                                {{ __('Dashboard') }}
                            </x-ui.button>
                        @else
                            <x-ui.button variant="ghost" :href="route('login')" wire:navigate>
                                {{ __('Log in') }}
                            </x-ui.button>

                            @if (Route::has('register'))
                                <x-ui.button variant="primary" :href="route('register')" wire:navigate>
                                    {{ __('Register') }}
                                </x-ui.button>
                            @endif
                        @endauth
                    </div>
                @endif
            </nav>
        </header>

        <main class="container flex-grow-1 py-5">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold mb-3">{{ __('Explore the world through whistles') }}</h1>

                    <p class="lead text-body-secondary mb-4">
                        {{ __('Open the map, find a whistle near you, and listen. Or record your own and pin it to where you are right now. No account needed to contribute.') }}
                    </p>

                    <div class="d-flex flex-wrap gap-2">
                        <x-ui.button variant="primary" size="lg" icon="pin" href="#">
                            {{ __('Explore the map') }}
                        </x-ui.button>

                        <x-ui.button variant="outline" size="lg" icon="mic" href="#">
                            {{ __('Record a whistle') }}
                        </x-ui.button>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <x-icon name="mic" size="1.5em" class="text-primary mb-2" />
                                    <h2 class="h6">{{ __('Record in the browser') }}</h2>
                                    <p class="text-body-secondary small mb-0">
                                        {{ __('No app, no upload dance. Hit record and it is on the map.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <x-icon name="pin" size="1.5em" class="text-primary mb-2" />
                                    <h2 class="h6">{{ __('Pinned where it happened') }}</h2>
                                    <p class="text-body-secondary small mb-0">
                                        {{ __('Every whistle keeps the exact spot it was whistled at.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <x-icon name="search" size="1.5em" class="text-primary mb-2" />
                                    <h2 class="h6">{{ __('Search nearby') }}</h2>
                                    <p class="text-body-secondary small mb-0">
                                        {{ __('Geospatial search finds what is whistling around you.') }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="card h-100">
                                <div class="card-body">
                                    <x-icon name="check" size="1.5em" class="text-primary mb-2" />
                                    <h2 class="h6">{{ __('Rate what you hear') }}</h2>
                                    <p class="text-body-secondary small mb-0">
                                        {{ __('Help the best whistles rise to the top.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <footer class="border-top bg-body">
            <div class="container py-3 text-body-secondary small">
                {{ config('app.name') }}
            </div>
        </footer>

        <x-ui.toasts />
    </body>
</html>
