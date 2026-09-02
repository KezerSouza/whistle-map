<?php

use App\Models\User;
use Laravel\Fortify\Features;
use Livewire\Livewire;

beforeEach(function () {
    $this->skipUnlessFortifyHas(Features::twoFactorAuthentication());

    Features::twoFactorAuthentication([
        'confirm' => true,
        'confirmPassword' => true,
    ]);
});

test('two factor setup modal stays closed until the setup starts', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('pages::settings.two-factor-setup-modal', ['requiresConfirmation' => true])
        ->assertOk()
        ->assertSet('show', false)
        ->assertSee('style="display: none"', escape: false);
});

test('two factor setup modal renders the qr code once the setup starts', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('pages::settings.two-factor-setup-modal', ['requiresConfirmation' => true])
        ->call('startTwoFactorSetup')
        ->assertHasNoErrors()
        ->assertSet('show', true)
        ->assertSee('Enable two-factor authentication')
        ->assertSee('style="display: block"', escape: false)
        ->assertSee('or, enter the code manually');
});

test('two factor setup modal closes and clears its state', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('pages::settings.two-factor-setup-modal', ['requiresConfirmation' => true])
        ->call('startTwoFactorSetup')
        ->call('closeModal')
        ->assertSet('show', false)
        ->assertSet('manualSetupKey', '')
        ->assertSet('qrCodeSvg', '');
});

test('recovery codes are listed for a user with two factor enabled', function () {
    $user = User::factory()->withTwoFactor()->create();

    $this->actingAs($user);

    Livewire::test('pages::settings.two-factor.recovery-codes')
        ->assertOk()
        ->assertSee('2FA recovery codes')
        ->assertSee('Regenerate codes');
});

test('delete account confirmation opens and closes from the profile form', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('pages::settings.delete-user-modal')
        ->assertSet('show', false)
        ->call('open')
        ->assertSet('show', true)
        ->assertSee('Are you sure you want to delete your account?')
        ->call('close')
        ->assertSet('show', false);
});
