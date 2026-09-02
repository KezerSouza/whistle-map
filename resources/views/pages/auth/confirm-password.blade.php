<x-layouts::auth :title="__('Confirm password')">
    <div class="d-flex flex-column gap-4">
        <x-auth-header
            :title="__('Confirm password')"
            :description="__('This is a secure area of the application. Please confirm your password before continuing.')"
        />

        <x-auth-session-status class="text-center" :status="session('status')" />

        <form method="POST" action="{{ route('password.confirm.store') }}" class="d-flex flex-column gap-3">
            @csrf

            <x-ui.input
                name="password"
                :label="__('Password')"
                type="password"
                required
                autofocus
                autocomplete="current-password"
                :placeholder="__('Password')"
                viewable
            />

            <x-ui.button variant="primary" type="submit" class="w-100" data-test="confirm-password-button">
                {{ __('Confirm') }}
            </x-ui.button>
        </form>
    </div>
</x-layouts::auth>
