<x-layouts::auth :title="__('Log in')">
    <div class="d-flex flex-column gap-4">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <!-- Session Status -->
        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('login.store') }}" class="d-flex flex-column gap-3">
            @csrf

            <!-- Email Address -->
            <x-ui.input
                name="email"
                :label="__('Email address')"
                :value="old('email')"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="email@example.com"
            />

            <!-- Password -->
            <div>
                <div class="d-flex justify-content-between align-items-center">
                    <label for="input-password" class="form-label mb-0">{{ __('Password') }}</label>

                    @if (Route::has('password.request'))
                        <a class="small" href="{{ route('password.request') }}" wire:navigate>
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <x-ui.input
                    class="mt-1"
                    name="password"
                    type="password"
                    required
                    autocomplete="current-password"
                    :placeholder="__('Password')"
                    viewable
                />
            </div>

            <!-- Remember Me -->
            <x-ui.checkbox name="remember" :label="__('Remember me')" :checked="(bool) old('remember')" />

            <x-ui.button variant="primary" type="submit" class="w-100" data-test="login-button">
                {{ __('Log in') }}
            </x-ui.button>
        </form>

        @if (Route::has('register'))
            <p class="text-center small text-body-secondary mb-0">
                {{ __('Don\'t have an account?') }}
                <a href="{{ route('register') }}" wire:navigate>{{ __('Sign up') }}</a>
            </p>
        @endif
    </div>
</x-layouts::auth>
