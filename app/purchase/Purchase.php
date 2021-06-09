<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    //purchase user name
    public function user(){
        return $this->belongsTo('App\User','purchased_by');
    }

     //purchase supplier name
    public function suppliers(){
        return $this->belongsTo('App\supplier\Supplier','supplier_id');
    }

     // this function shows all purchase item list
      public function purchaseItem(){
          return $this->hasMany('App\purchase\PurchaseItem','purchase_id');
      }

}
