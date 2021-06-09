<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
      // this function shows product warehouse name
      public function productWarehouses(){
          return $this->hasMany('App\product\ProductWarehouse','product_id');
      }

       // this function shows all temporary purchase
      public function temporaryPurchases(){
          return $this->hasMany('App\purchase\TemporaryPurchase','product_id');
      }

      //this function show product category name
      public function category(){
          return $this->belongsTo('App\category\Category','product_cat_id');
      }

     //this function show product category name
      public function brand(){
          return $this->belongsTo('App\brand\Brand','product_brand');
      }
}
