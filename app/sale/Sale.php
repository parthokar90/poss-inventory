<?php

namespace App\sale;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
     //sale user name
    public function user(){
        return $this->belongsTo('App\User','sale_by');
    }

     //sale customer name
    public function customers(){
        return $this->belongsTo('App\customer\Customer','customer_id');
    }

   //sale biller name
    public function billers(){
        return $this->belongsTo('App\biller\Biller','biller_id');
    }

      // this function shows all purchase item list
      public function saleItem(){
          return $this->hasMany('App\sale\SaleItem','sales_id');
      }
}
