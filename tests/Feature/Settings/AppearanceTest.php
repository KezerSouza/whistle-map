<?php

use App\Models\User;

test('appearance settings page can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('appearance.edit'))
        ->assertOk()
        ->assertSee('Appearance')
        ->assertSee('data-theme-value="light"', escape: false)
        ->assertSee('data-theme-value="dark"', escape: false)
        ->assertSee('data-theme-value="system"', escape: false);
});
