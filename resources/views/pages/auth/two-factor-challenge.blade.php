@php
    $mode = $errors->has('recovery_code') ? 'recovery' : 'code';
@endphp

<x-layouts::auth :title="__('Two-factor authentication')">
    <div class="d-flex flex-column gap-4">
        <div class="{{ $mode === 'code' ? '' : 'd-none' }}" data-otp-mode-header="code">
            <x-auth-header
                :title="__('Authentication code')"
                :description="__('Enter the authentication code provided by your authenticator application.')"
            />
        </div>

        <div class="{{ $mode === 'recovery' ? '' : 'd-none' }}" data-otp-mode-header="recovery">
            <x-auth-header
                :title="__('Recovery code')"
                :description="__('Please confirm access to your account by entering one of your emergency recovery codes.')"
            />
        </div>

        <form method="POST" action="{{ route('two-factor.login.store') }}" data-otp-modes="{{ $mode }}">
            @csrf

            <div class="d-flex flex-column gap-4 text-center">
                <div class="{{ $mode === 'code' ? '' : 'd-none' }}" data-otp-mode="code">
                    <x-ui.otp
                        name="code"
                        :label="__('Authentication code')"
                        length="6"
                        autofocus
                        @disabled($mode !== 'code')
                        @required($mode === 'code')
                    />
                </div>

                <div class="{{ $mode === 'recovery' ? '' : 'd-none' }}" data-otp-mode="recovery">
                    <x-ui.input
                        name="recovery_code"
                        :label="__('Recovery code')"
                        type="text"
                        autocomplete="one-time-code"
                        @disabled($mode !== 'recovery')
                        @required($mode === 'recovery')
                    />
                </div>

                <x-ui.button variant="primary" type="submit" class="w-100">
                    {{ __('Continue') }}
                </x-ui.button>
            </div>

            <p class="mt-4 mb-0 text-center small text-body-secondary">
                {{ __('or you can') }}
                <button type="button" class="btn btn-link btn-sm p-0 align-baseline" data-otp-mode-toggle>
                    <span data-otp-mode-label="code" class="{{ $mode === 'code' ? '' : 'd-none' }}">{{ __('login using a recovery code') }}</span>
                    <span data-otp-mode-label="recovery" class="{{ $mode === 'recovery' ? '' : 'd-none' }}">{{ __('login using an authentication code') }}</span>
                </button>
            </p>
        </form>
    </div>
</x-layouts::auth>
