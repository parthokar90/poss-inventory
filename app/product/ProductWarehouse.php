<?php

namespace App\product;

use Illuminate\Database\Eloquent\Model;

class ProductWarehouse extends Model
{
     // this function shows  warehouse name
      public function Warehouses(){
          return $this->belongsTo('App\Warehouse\Warehouse','warehouse_id');
      }

      // this function shows variant name
      public function Varient(){
          return $this->belongsTo('App\varients\Varients','varient_id');
      }

     // this function shows product details
      public function Products(){
          return $this->belongsTo('App\product\Product','product_id');
      }
}
