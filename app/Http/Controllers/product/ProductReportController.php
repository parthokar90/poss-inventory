<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\product\Product;

class ProductReportController extends Controller
{
    public function index(){
        $product=Product::orderBy('id','DESC')->get();
        dd(        $product);
        return view('');
    }

    public function productReport(Request $request){

    }
}
