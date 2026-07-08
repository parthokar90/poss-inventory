<?php

namespace App\Services;

use App\Models\Product;
use App\Models\SellProduct; // মডেল ব্যবহার করছি
use App\Models\SaleVatTemp;
use App\Models\SaleDiscountTemp;

class POSService
{
    public function addProductToCart($id) {
        $product = Product::findOrFail($id);
        
        $cartItem = SellProduct::where('product_id', $id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
            $cartItem->update(['sub_total' => $product->product_price * $cartItem->quantity]);
        } else {
            SellProduct::create([
                'product_id' => $id,
                'price'      => $product->product_price,
                'quantity'   => 1,
                'sub_total'  => $product->product_price,
            ]);
        }
        return $this->getCartItems();
    }

    public function getCartItems() {
        return SellProduct::with('product:id,product_name')
            ->get()
            ->map(fn($item) => [
                'id'           => $item->id,
                'product_name' => $item->product->product_name,
                'price'        => number_format($item->price),
                'quantity'     => $item->quantity,
                'sub_total'    => number_format($item->sub_total),
            ]);
    }

    public function updateItem($id, $qty) {
        $item = SellProduct::findOrFail($id);
        $item->update([
            'quantity'  => $qty,
            'sub_total' => $item->price * $qty,
        ]);
    }

    public function updateVat($input) {
        $total = SellProduct::sum('sub_total');
        SaleVatTemp::truncate();
        SaleVatTemp::create(['vat_amount' => ($total / 100) * $input]);
    }

    public function updateDiscount($input) {
        $total = SellProduct::sum('sub_total');
        SaleDiscountTemp::truncate();
        SaleDiscountTemp::create(['discount_amount' => ($total / 100) * $input]);
    }

    public function getTotalCalculation() {
        $vat      = SaleVatTemp::sum('vat_amount');
        $discount = SaleDiscountTemp::sum('discount_amount');
        $subtotal = SellProduct::sum('sub_total');
        return number_format(($subtotal + $vat) - $discount);
    }
}