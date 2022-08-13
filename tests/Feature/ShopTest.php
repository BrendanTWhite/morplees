<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class ShopTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_shops_list_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/shops/');

        $response->assertStatus(200);
        $this->assertAuthenticated();
        $response->assertSee('Shops');
        $response->assertSee('New shop');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_shop_page_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->get('/shops/create');

        $response->assertStatus(200);
        $this->assertAuthenticated();
        $response->assertSee('Create shop');
        $response->assertSee('create another');
    }

}
