<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\product\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StockTest extends TestCase
{
    use RefreshDatabase;

    public function test_stock_increases()
    {
        $product = factory(Product::class)->create([
            'product_qty' => 10
        ]);

        $product->increment('product_qty', 5);

        $this->assertEquals(15, $product->fresh()->product_qty);
    }

    public function test_stock_decreases()
    {
        $product = factory(Product::class)->create([
            'product_qty' => 20
        ]);

        $product->decrement('product_qty', 3);

        $this->assertEquals(17, $product->fresh()->product_qty);
    }
}