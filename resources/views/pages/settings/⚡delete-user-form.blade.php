<?php

use Livewire\Component;

new class extends Component {}; ?>

<section class="mt-5">
    <h3 class="h6 mb-1">{{ __('Delete account') }}</h3>
    <p class="text-body-secondary small">{{ __('Delete your account and all of its resources') }}</p>

    <x-ui.button
        variant="danger"
        wire:click="$dispatch('open-delete-user-modal')"
        data-test="delete-user-button"
    >
        {{ __('Delete account') }}
    </x-ui.button>

    <livewire:pages::settings.delete-user-modal />
</section>
