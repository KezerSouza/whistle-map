<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-vh-100 bg-body-tertiary">
        <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
            <div class="w-100" style="max-width: 24rem">
                <a href="{{ route('home') }}" class="d-flex flex-column align-items-center gap-2 text-decoration-none text-body mb-4" wire:navigate>
                    <x-app-logo-icon style="width: 2.25rem; height: 2.25rem" />
                    <span class="visually-hidden">{{ config('app.name', 'Laravel') }}</span>
                </a>

                {{ $slot }}
            </div>
        </div>

        <x-ui.toasts />
    </body>
</html>
