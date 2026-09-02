<?php

use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Appearance settings')] class extends Component {
    //
}; ?>

<section class="w-100">
    @include('partials.settings-heading')

    <h2 class="visually-hidden">{{ __('Appearance settings') }}</h2>

    <x-pages::settings.layout :heading="__('Appearance')" :subheading="__('Update the appearance settings for your account')">
        {{--
            The preference lives in the browser (localStorage) and is applied to
            Bootstrap's `data-bs-theme` attribute, so there is no server state.
        --}}
        <div class="btn-group" role="group" aria-label="{{ __('Appearance') }}">
            <input type="radio" class="btn-check" name="appearance" id="appearance-light" data-theme-value="light" autocomplete="off">
            <label class="btn btn-outline-secondary d-inline-flex align-items-center gap-2" for="appearance-light">
                <x-icon name="sun" />
                {{ __('Light') }}
            </label>

            <input type="radio" class="btn-check" name="appearance" id="appearance-dark" data-theme-value="dark" autocomplete="off">
            <label class="btn btn-outline-secondary d-inline-flex align-items-center gap-2" for="appearance-dark">
                <x-icon name="moon" />
                {{ __('Dark') }}
            </label>

            <input type="radio" class="btn-check" name="appearance" id="appearance-system" data-theme-value="system" autocomplete="off">
            <label class="btn btn-outline-secondary d-inline-flex align-items-center gap-2" for="appearance-system">
                <x-icon name="desktop" />
                {{ __('System') }}
            </label>
        </div>
    </x-pages::settings.layout>
</section>
