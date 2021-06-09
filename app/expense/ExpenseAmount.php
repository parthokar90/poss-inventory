<?php

namespace App\expense;

use Illuminate\Database\Eloquent\Model;

class ExpenseAmount extends Model
{
     // this function shows expense category name
     public function ExpenseCategorys(){
          return $this->belongsTo('App\Expense\ExpenseCategory','category_id');
     }

     // this function shows expense warehouse name
     public function Warehouses(){
          return $this->belongsTo('App\Warehouse\Warehouse','warehouse_id');
     }

      // this function shows expense user name
     public function users(){
          return $this->belongsTo('App\User','created_by');
     }
}
