<?php

namespace App\purchase;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
        //purchase user name
    public function user(){
        return $this->belongsTo('App\User','purchased_by');
    }

     //purchase supplier name
    public function suppliers(){
        return $this->belongsTo('App\supplier\Supplier','supplier_id');
    }

    //purchase invoice
    public function purchase(){
        return $this->belongsTo('App\purchase\Purchase','purchase_id');
    }
}
