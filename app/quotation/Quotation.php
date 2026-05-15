<?php

namespace App\quotation;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    //this function is for multiple item for quotation 
    public function quotationItems(){
        return $this->hasMany(Quotation::class,'quotation_id');
    }

    //this function is for 
}
