<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable = [
        'product_type',
        'product_name',
        'product_slug',
        'product_code',
        'product_cost',
        'product_price',
        'product_alert_qty',
        'product_weight',
        'product_brand',
        'product_cat_id',
        'product_subcat_id',
        'product_unit_id',
        'tax_rate_id',
        'product_details',
        'product_image',
    ];
    // this function shows product warehouse name
    public function productWarehouses()
    {
        return $this->hasMany('App\product\ProductWarehouse', 'product_id');
    }

    // this function shows all temporary purchase
    public function temporaryPurchases()
    {
        return $this->hasMany('App\purchase\TemporaryPurchase', 'product_id');
    }

    //this function show product category name
    public function category()
    {
        return $this->belongsTo('App\category\Category', 'product_cat_id');
    }

    //this function show product category name
    public function brand()
    {
        return $this->belongsTo('App\brand\Brand', 'product_brand');
    }
}
