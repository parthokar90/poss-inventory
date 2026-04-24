<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\product\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function product_list_page_loads_successfully()
    {
        $response = $this->get('/products');

        $response->assertStatus(200);
    }

    /** @test */
    public function product_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/products', [
            'name' => 'Laptop',
            'price' => 50000,
            'stock' => 10
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('products', [
            'name' => 'Laptop'
        ]);
    }

    /** @test */
    public function product_can_be_updated()
    {
        $product = Product::factory()->create();

        $response = $this->put("/products/{$product->id}", [
            'name' => 'Updated Laptop',
            'price' => 60000
        ]);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', [
            'name' => 'Updated Laptop'
        ]);
    }
}