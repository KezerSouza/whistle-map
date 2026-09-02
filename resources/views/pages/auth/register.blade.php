<x-layouts::auth :title="__('Register')">
    <div class="d-flex flex-column gap-4">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('register.store') }}" class="d-flex flex-column gap-3">
            @csrf

            <!-- Name -->
            <x-ui.input
                name="name"
                :label="__('Name')"
                :value="old('name')"
                type="text"
                required
                autofocus
                autocomplete="name"
                :placeholder="__('Full name')"
            />

            <!-- Email Address -->
            <x-ui.input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <x-ui.input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Password')"
                viewable
            />

            <!-- Confirm Password -->
            <x-ui.input
                name="password_confirmation"
                :label="__('Confirm password')"
                type="password"
                required
                autocomplete="new-password"
                :placeholder="__('Confirm password')"
                viewable
            />

            <x-ui.button type="submit" variant="primary" class="w-100" data-test="register-user-button">
                {{ __('Create account') }}
            </x-ui.button>
        </form>

        <p class="text-center small text-body-secondary mb-0">
            {{ __('Already have an account?') }}
            <a href="{{ route('login') }}" wire:navigate>{{ __('Log in') }}</a>
        </p>
    </div>
</x-layouts::auth>
