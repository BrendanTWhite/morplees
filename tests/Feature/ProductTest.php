<?php

// use App\Models\Product;
// use App\Models\User;

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

test('example', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

 
it('can render empty Products list')
    ->get('/products')
    ->assertSeeInOrder([
    	'Products',
    	'New product',
    	'No records found',
    ]);


it('can render populated Products list', function() {

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
        ->assertStatus(200);
    $this->assertAuthenticated();

    $response
        ->assertSeeInOrder([
            'Products',
            'New product',            
        ])
        //->assertSee('No records found')
        ->assertSeeInOrder([
            'Need Soon',
            'Name',
            'Shop',
            'Usually Need',
        ])
        ->assertSeeInOrder([
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
    	'Select an option',
    	'Default in list',
    	'Needed soon',
    	'Create',
    	'Create & create another',
		'Cancel',
    ]);

