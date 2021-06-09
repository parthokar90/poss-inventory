<?php

namespace App\varients;

use Illuminate\Database\Eloquent\Model;

class ProductVarient extends Model
{
      public function Varient(){
          return $this->belongsTo('App\varients\Varients','varient_id');
      }
       // this function shows expense warehouse name
      public function Warehouses(){
          return $this->belongsTo('App\Warehouse\Warehouse','warehouse_id');
      }
}
