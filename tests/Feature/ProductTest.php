<?php

// use App\Models\Product;
// use App\Models\User;

beforeEach(function () {
    $user = App\Models\User::factory()->create();
    $product1 = App\Models\Product::factory()->create();

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


// it('can render populated Products list', function() {

// 	$product1 = Product::factory()->create();
// 	$product2 = Product::factory()->create();
// 	$product3 = Product::factory()->create();

//     $response = $this
//         ->get('/products');

//     $response->assertStatus(200);
//     $this->assertAuthenticated();
//     $response->assertSee('Shops');
//     $response->assertSee('New shop');

//     $response
//     ->assertSeeInOrder([
//     	'Products',
//     	'New product',
//     	'Needed Soon',
//     	'Name',
//     	'Shop',
//     	'Usually Need',
//     	$product1->name,
//     ])
//     ->assertSee($product2->name)
//     ->assertSee($product3->name);

// });

 
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

