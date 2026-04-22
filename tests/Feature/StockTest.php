<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function stock_increases_when_purchase_is_made()
    {
        $product = Product::factory()->create([
            'stock' => 10
        ]);

        $product->increment('stock', 5);

        $this->assertEquals(15, $product->stock);
    }

    /** @test */
    public function stock_decreases_when_sale_is_made()
    {
        $product = Product::factory()->create([
            'stock' => 20
        ]);

        $product->decrement('stock', 3);

        $this->assertEquals(17, $product->fresh()->stock);
    }
}