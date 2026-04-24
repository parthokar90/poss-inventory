<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use App\product\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function sale_can_be_created_and_stock_decreases()
    {
        $user = User::factory()->create();

        $product = Product::factory()->create([
            'product_qty' => 10
        ]);

        $response = $this->actingAs($user)->post('/sales', [
            'customer_id' => 1,
            'sale_date' => now()->format('Y-m-d'),
            'sale_by' => $user->id,
            'items' => [
                [
                    'product_id' => $product->id,
                    'quantity' => 2,
                    'price' => 500
                ]
            ]
        ]);

        $response->assertStatus(302);

        // stock should reduce
        $this->assertEquals(8, $product->fresh()->product_qty);

        $this->assertDatabaseHas('sales', [
            'sale_by' => $user->id
        ]);
    }
}