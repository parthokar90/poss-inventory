<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class TemporaryPurchase extends Model
{
       // this function shows all temporary purchase
      public function products(){
          return $this->belongsTo('App\product\Product','product_id');
      }
}
