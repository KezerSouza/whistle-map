<x-layouts::auth :title="__('Forgot password')">
    <div class="d-flex flex-column gap-4">
        <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="d-flex flex-column gap-3">
            @csrf

            <!-- Email Address -->
            <x-ui.input
                name="email"
                :label="__('Email address')"
                type="email"
                required
                autofocus
                placeholder="email@example.com"
            />

            <x-ui.button variant="primary" type="submit" class="w-100" data-test="email-password-reset-link-button">
                {{ __('Email password reset link') }}
            </x-ui.button>
        </form>

        <p class="text-center small text-body-secondary mb-0">
            {{ __('Or, return to') }}
            <a href="{{ route('login') }}" wire:navigate>{{ __('log in') }}</a>
        </p>
    </div>
</x-layouts::auth>
