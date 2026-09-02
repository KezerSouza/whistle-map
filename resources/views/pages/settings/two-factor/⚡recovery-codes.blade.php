<?php

use Laravel\Fortify\Actions\GenerateNewRecoveryCodes;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component {
    /** @var array<int, string> */
    #[Locked]
    public array $recoveryCodes = [];

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->loadRecoveryCodes();
    }

    /**
     * Generate new recovery codes for the user.
     */
    public function regenerateRecoveryCodes(GenerateNewRecoveryCodes $generateNewRecoveryCodes): void
    {
        $generateNewRecoveryCodes(auth()->user());

        $this->loadRecoveryCodes();
    }

    /**
     * Load the recovery codes for the user.
     */
    private function loadRecoveryCodes(): void
    {
        $user = auth()->user();

        if ($user->hasEnabledTwoFactorAuthentication() && $user->two_factor_recovery_codes) {
            try {
                $this->recoveryCodes = json_decode(decrypt($user->two_factor_recovery_codes), true);
            } catch (Exception) {
                $this->addError('recoveryCodes', 'Failed to load recovery codes');

                $this->recoveryCodes = [];
            }
        }
    }
}; ?>

<div class="card" wire:cloak>
    <div class="card-body">
        <h4 class="h6 d-flex align-items-center gap-2 mb-2">
            <x-icon name="lock" />
            {{ __('2FA recovery codes') }}
        </h4>

        <p class="text-body-secondary small">
            {{ __('Recovery codes let you regain access if you lose your 2FA device. Store them in a secure password manager.') }}
        </p>

        <div class="d-flex flex-column flex-sm-row gap-2">
            <x-ui.button
                variant="primary"
                icon="eye"
                data-bs-toggle="collapse"
                data-bs-target="#recovery-codes-section"
                aria-expanded="false"
                aria-controls="recovery-codes-section"
            >
                {{ __('View recovery codes') }}
            </x-ui.button>

            @if (filled($recoveryCodes))
                <x-ui.button variant="filled" wire:click="regenerateRecoveryCodes">
                    {{ __('Regenerate codes') }}
                </x-ui.button>
            @endif
        </div>

        <div class="collapse mt-3" id="recovery-codes-section">
            @error('recoveryCodes')
                <x-ui.callout variant="danger" :heading="$message" />
            @enderror

            @if (filled($recoveryCodes))
                <ul
                    class="list-unstyled font-monospace small bg-body-secondary rounded p-3 mb-2"
                    aria-label="{{ __('Recovery codes') }}"
                >
                    @foreach ($recoveryCodes as $code)
                        <li wire:loading.class="opacity-50">{{ $code }}</li>
                    @endforeach
                </ul>

                <p class="text-body-secondary mb-0" style="font-size: .75rem">
                    {{ __('Each recovery code can be used once to access your account and will be removed after use. If you need more, click Regenerate codes above.') }}
                </p>
            @endif
        </div>
    </div>
</div>
