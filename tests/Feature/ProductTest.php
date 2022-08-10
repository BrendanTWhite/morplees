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

it('can render empty Products list')
    ->get('/products')
    ->assertOk()
    ->assertSeeInOrder([
        'Products',
        'New product',
        'No records found',
    ]);


it('can render populated Products list', function () {
    global $user, $shop;

    $product1 = App\Models\Product::factory([
        'family_id' => $user->family_id,
        'shop_id'   => $shop->id,
        ])->create();

    $product2 = App\Models\Product::factory([
        'family_id' => $user->family_id,
        'shop_id'   => $shop->id,
        ])->create();

    $product3 = App\Models\Product::factory([
        'family_id' => $user->family_id,
        'shop_id'   => $shop->id,
        ])->create();

    $response = $this
        ->get('/products')
        ->assertOk();
    $this->assertAuthenticated();

    $response
        ->assertSeeInOrder([
            'Products',
            'New product',
            'Need Soon',
            'Name',
            'Shop',
            'Usually Need',
            $product1->name,
            $product2->name,
            $product3->name,
        ]);
});

it('can render empty New Product form')
    ->get('/products/create')
    ->assertSeeInOrder([
        'Create product',
        'Name',
        'Select an option',
        'Default in list',
        'Needed soon',
        'Create',
        'Create & create another',
        'Cancel',
    ]);

it('can render populated New Product form')
    ->get('/products/create')
    ->assertSeeInOrder([
        'Create product',
        'Name',
        'Shop',
        'Default in list',
        'Needed soon',
        'Create',
        'Create & create another',
        'Cancel',
    ]);
