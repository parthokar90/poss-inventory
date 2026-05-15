<?php

namespace App\supplier;

use Illuminate\Database\Eloquent\Model;

class SupplierPayment extends Model
{
    //purchase user name
    public function user(){
        return $this->belongsTo('App\User','payment_by');
    }

     //purchase supplier name
    public function suppliers(){
        return $this->belongsTo('App\supplier\Supplier','supplier_id');
    }

}
