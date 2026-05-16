<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;
use App\warehouse\Warehouse;
use App\varients\Varients;
use App\product\Product;

class ProductWarehouse extends Model
{
    public function Warehouses()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function Varient()
    {
        return $this->belongsTo(Varients::class, 'varient_id');
    }

    public function Products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}