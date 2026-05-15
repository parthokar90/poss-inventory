<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\product\Product;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function product_list_page_loads_successfully()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/product');

        $response->assertStatus(200);
    }

    /** @test */
    public function product_can_be_created()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/product', [
            'product_type' => 'simple',
            'product_name' => 'Laptop',
            'product_cost' => 40000,
            'product_price' => 50000,
            'product_alert_qty' => 2,
            'warehouse_id' => 1,

            // variant data (safe array inputs)
            'variant_warehouse_id' => [1],
            'varient_id' => [1],
            'price_addition' => [0],
            'variant_qty' => [10],
            'variant_rack' => ['A1']
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'product_name' => 'Laptop'
        ]);
    }

    /** @test */
    public function product_can_be_updated()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create();

        $response = $this->actingAs($user)->put("/product/{$product->id}", [
            'product_name' => 'Updated Laptop',
            'product_price' => 60000
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'product_name' => 'Updated Laptop'
        ]);
    }
}