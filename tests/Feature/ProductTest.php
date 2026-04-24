<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\product\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function product_list_page_loads_successfully()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
            ->get('/product');

        $response->assertStatus(200);
    }

    /** @test */
    public function product_can_be_created()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->post('/product', [
            'name' => 'Laptop',
            'price' => 50000,
            'stock' => 10
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'name' => 'Laptop'
        ]);
    }

    /** @test */
    public function product_can_be_updated()
    {
        $user = factory(User::class)->create();

        $product = factory(Product::class)->create();

        $response = $this->actingAs($user)->put("/product/{$product->id}", [
            'name' => 'Updated Laptop',
            'price' => 60000
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'name' => 'Updated Laptop'
        ]);
    }
}