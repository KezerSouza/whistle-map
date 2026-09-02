<?php

use App\Concerns\PasswordValidationRules;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

new class extends Component {
    use PasswordValidationRules;

    public bool $show = false;

    public string $password = '';

    /**
     * Open the confirmation modal.
     */
    #[On('open-delete-user-modal')]
    public function open(): void
    {
        $this->reset('password');
        $this->resetErrorBag();

        $this->show = true;
    }

    /**
     * Close the confirmation modal.
     */
    public function close(): void
    {
        $this->reset('password', 'show');
        $this->resetErrorBag();
    }

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => $this->currentPasswordRules(),
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<x-ui.modal :show="$show" size="modal-lg">
    <form wire:submit="deleteUser">
        <div class="modal-header">
            <h2 class="modal-title h5">{{ __('Are you sure you want to delete your account?') }}</h2>

            <button type="button" class="btn-close" wire:click="close" aria-label="{{ __('Close') }}"></button>
        </div>

        <div class="modal-body d-flex flex-column gap-3">
            <p class="text-body-secondary mb-0">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <x-ui.input wire:model="password" :label="__('Password')" type="password" viewable />
        </div>

        <div class="modal-footer">
            <x-ui.button variant="filled" wire:click="close">{{ __('Cancel') }}</x-ui.button>

            <x-ui.button variant="danger" type="submit" data-test="confirm-delete-user-button">
                {{ __('Delete account') }}
            </x-ui.button>
        </div>
    </form>
</x-ui.modal>
