<?php

use Laravel\Fortify\Actions\ConfirmTwoFactorAuthentication;
use Laravel\Fortify\Actions\EnableTwoFactorAuthentication;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

new class extends Component {
    #[Locked]
    public bool $requiresConfirmation;

    #[Locked]
    public string $qrCodeSvg = '';

    #[Locked]
    public string $manualSetupKey = '';

    public bool $show = false;

    public bool $showVerificationStep = false;

    public bool $setupComplete = false;

    #[Validate('required|string|size:6', onUpdate: false)]
    public string $code = '';

    /**
     * Mount the component.
     */
    public function mount(bool $requiresConfirmation): void
    {
        $this->requiresConfirmation = $requiresConfirmation;
    }

    #[On('start-two-factor-setup')]
    public function startTwoFactorSetup(): void
    {
        $enableTwoFactorAuthentication = app(EnableTwoFactorAuthentication::class);
        $enableTwoFactorAuthentication(auth()->user());

        $this->show = true;

        $this->loadSetupData();
    }

    /**
     * Load the two-factor authentication setup data for the user.
     */
    private function loadSetupData(): void
    {
        $user = auth()->user()?->fresh();

        try {
            if (! $user || ! $user->two_factor_secret) {
                throw new Exception('Two-factor setup secret is not available.');
            }

            $this->qrCodeSvg = $user->twoFactorQrCodeSvg();
            $this->manualSetupKey = decrypt($user->two_factor_secret);
        } catch (Exception) {
            $this->addError('setupData', 'Failed to fetch setup data.');

            $this->reset('qrCodeSvg', 'manualSetupKey');
        }
    }

    /**
     * Show the two-factor verification step if necessary.
     */
    public function showVerificationIfNecessary(): void
    {
        if ($this->requiresConfirmation) {
            $this->showVerificationStep = true;

            $this->resetErrorBag();

            return;
        }

        $this->closeModal();
        $this->dispatch('two-factor-enabled');
    }

    /**
     * Confirm two-factor authentication for the user.
     */
    public function confirmTwoFactor(ConfirmTwoFactorAuthentication $confirmTwoFactorAuthentication): void
    {
        $this->validate();

        $confirmTwoFactorAuthentication(auth()->user(), $this->code);

        $this->setupComplete = true;

        $this->closeModal();

        $this->dispatch('two-factor-enabled');
    }

    /**
     * Reset two-factor verification state.
     */
    public function resetVerification(): void
    {
        $this->reset('code', 'showVerificationStep');

        $this->resetErrorBag();
    }

    /**
     * Close the two-factor authentication modal.
     */
    public function closeModal(): void
    {
        $this->reset(
            'code',
            'manualSetupKey',
            'qrCodeSvg',
            'show',
            'showVerificationStep',
            'setupComplete',
        );

        $this->resetErrorBag();
    }

    /**
     * Get the current modal configuration state.
     *
     * @return array{title: string, description: string, buttonText: string}
     */
    #[Computed]
    public function modalConfig(): array
    {
        if ($this->setupComplete) {
            return [
                'title' => __('Two-factor authentication enabled'),
                'description' => __('Two-factor authentication is now enabled. Scan the QR code or enter the setup key in your authenticator app.'),
                'buttonText' => __('Close'),
            ];
        }

        if ($this->showVerificationStep) {
            return [
                'title' => __('Verify authentication code'),
                'description' => __('Enter the 6-digit code from your authenticator app.'),
                'buttonText' => __('Continue'),
            ];
        }

        return [
            'title' => __('Enable two-factor authentication'),
            'description' => __('To finish enabling two-factor authentication, scan the QR code or enter the setup key in your authenticator app.'),
            'buttonText' => __('Continue'),
        ];
    }
}; ?>

<x-ui.modal :show="$show" size="modal-md">
    <div class="modal-header">
        <h2 class="modal-title h5 d-flex align-items-center gap-2">
            <x-icon name="qr-code" size="1.25em" />
            {{ $this->modalConfig['title'] }}
        </h2>

        <button type="button" class="btn-close" wire:click="closeModal" aria-label="{{ __('Close') }}"></button>
    </div>

    <div class="modal-body d-flex flex-column gap-4">
        <p class="text-body-secondary mb-0">{{ $this->modalConfig['description'] }}</p>

        @if ($showVerificationStep)
            <x-ui.otp name="code" wire:model="code" :label="__('Authentication code')" length="6" />

            <div class="d-flex gap-2">
                <x-ui.button variant="outline" class="flex-fill" wire:click="resetVerification">
                    {{ __('Back') }}
                </x-ui.button>

                <x-ui.button variant="primary" class="flex-fill" wire:click="confirmTwoFactor">
                    {{ __('Confirm') }}
                </x-ui.button>
            </div>
        @else
            @error('setupData')
                <x-ui.callout variant="danger" :heading="$message" />
            @enderror

            <div class="d-flex justify-content-center">
                <div class="border rounded p-3 bg-white" style="width: 16rem; height: 16rem">
                    @empty($qrCodeSvg)
                        <div class="d-flex align-items-center justify-content-center h-100 placeholder-glow">
                            <span class="placeholder col-12 h-100"></span>
                        </div>
                    @else
                        <div class="d-flex align-items-center justify-content-center h-100">
                            {!! $qrCodeSvg !!}
                        </div>
                    @endempty
                </div>
            </div>

            <x-ui.button
                variant="primary"
                class="w-100"
                :disabled="$errors->has('setupData')"
                wire:click="showVerificationIfNecessary"
            >
                {{ $this->modalConfig['buttonText'] }}
            </x-ui.button>

            <div>
                <p class="text-center text-body-secondary small mb-2">{{ __('or, enter the code manually') }}</p>

                <div class="input-group">
                    @empty($manualSetupKey)
                        <span class="form-control placeholder-glow"><span class="placeholder col-8"></span></span>
                    @else
                        <input
                            type="text"
                            id="two-factor-manual-key"
                            class="form-control font-monospace"
                            value="{{ $manualSetupKey }}"
                            readonly
                        />

                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            data-clipboard-copy="#two-factor-manual-key"
                            aria-label="{{ __('Copy setup key') }}"
                        >
                            <x-icon name="copy" data-clipboard-idle />
                            <x-icon name="check" class="d-none text-success" data-clipboard-done />
                        </button>
                    @endempty
                </div>
            </div>
        @endif
    </div>
</x-ui.modal>
