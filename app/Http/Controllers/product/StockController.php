<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\product\Product;
use App\Product\ProductWarehouse;
use App\varients\ProductVarient;

class StockController extends Controller
{
    //all stock list
    public function stockList(){
        $list=Product::orderBy('id','DESC')->simplePaginate(10);
        return view('product.stock_list',compact('list'));
    }

    public function stockSearchProduct(Request $request){
       $search=$request->search;
       $count=Product::where('product_name','LIKE',"%{$search}%")->orWhere('product_code','LIKE',"%{$search}%")->count();
       if($count==0){
        session()->flash("error","No Product found");
        return redirect(route('stockList'));
       }
       $list=Product::where('product_name','LIKE',"%{$search}%")->orWhere('product_code','LIKE',"%{$search}%")->orderBy('id','DESC')->simplePaginate(10);
       return view('product.stock_list',compact('list'));
    }

    public function stockAlertNotification(){
        $alert_notify=ProductWarehouse::whereRaw('qty<=alert_qty')->with('Warehouses','Varient','Products')->simplePaginate(20);
        return view('product.notifications',compact('alert_notify'));
    }
}
