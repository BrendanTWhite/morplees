<?php

$user = null;
$shop = null;

beforeEach(function () {
    global $user, $shop;
    $user = App\Models\User::factory()->create();
    $shop = App\Models\Shop::factory(['family_id' => $user->family_id])->create();
    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);
});

it('can render Home Page')
    ->get('/')
    ->assertOk()
    ->assertSeeInOrder([
        'New List',
        'Menu',
        'Pantry',
        'Shopping',
    ]);
