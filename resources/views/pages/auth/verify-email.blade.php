<x-layouts::auth :title="__('Email verification')">
    <div class="d-flex flex-column gap-4">
        <p class="text-center text-body-secondary mb-0">
            {{ __('Please verify your email address by clicking on the link we just emailed to you.') }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="alert alert-success text-center mb-0" role="status">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="d-flex flex-column align-items-center gap-3">
            <form method="POST" action="{{ route('verification.send') }}" class="w-100">
                @csrf

                <x-ui.button type="submit" variant="primary" class="w-100">
                    {{ __('Resend verification email') }}
                </x-ui.button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-ui.button variant="ghost" type="submit" size="sm" data-test="logout-button">
                    {{ __('Log out') }}
                </x-ui.button>
            </form>
        </div>
    </div>
</x-layouts::auth>
