<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\product\Product;
use App\supplier\Supplier;
use App\customer\Customer;
use App\User;
use App\purchase\Purchase;
use App\sale\Sale;
use App\expense\ExpenseAmount;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // after login then redirect to dashboard
    public function Dashboard(){
       $total_product=Product::count();
       $total_users=User::count();
       $total_supplier=Supplier::count();
       $total_customer=Customer::count();
       $today_purchase=Purchase::where('purchase_date',date('Y-m-d'))->sum('total_price');
       $today_sales=Sale::where('sale_date',date('Y-m-d'))->sum('total_price');
       $today_expense=ExpenseAmount::where('expense_date',date('Y-m-d'))->sum('expense_amount');
       $purchase_list=Purchase::where('purchase_date',date('Y-m-d'))->orderBy('id','DESC')->with('user','suppliers')->get();
       $sales_list=Sale::where('sale_date',date('Y-m-d'))->orderBy('id','DESC')->with('user','customers')->get();
       return view('admin.dashboard.dashboard',compact('total_product','total_users','total_supplier','total_customer','purchase_list','today_purchase','today_sales','today_expense','sales_list'));
    }


}
