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
            'product_type' => 'simple',
            'product_name' => 'Laptop',
            'product_cost' => 40000,
            'product_price' => 50000,
            'product_alert_qty' => 2,
            'warehouse_id' => 1,

            // IMPORTANT (fix crash)
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
        $user = factory(User::class)->create();

        $product = factory(Product::class)->create();

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
