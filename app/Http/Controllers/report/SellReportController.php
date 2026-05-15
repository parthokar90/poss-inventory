<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\customer\Customer;
use App\sale\Sale;
use App\company\Company;
use PDF;

class SellReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //purchase report view
    public function saleReport(){
       $customer=Customer::where('status',1)->orderBy('id','DESC')->get(); 
       return view('report.sell.index',compact('customer'));
    }

     //sell report show supplier
    public function saleReportShowCustomer(Request $request){
       $start=$request->start; 
       $end=$request->end; 
       $company=Company::first();
       $count=Sale::where('customer_id',$request->supplier_id)->whereBetween('sale_date',[$start,$end])->count();
       if($count==0){
         session()->flash("error","No Data Found");
         return back();
       }
       $data=Sale::where('customer_id',$request->supplier_id)->whereBetween('sale_date',[$start,$end])->with('customers','user')->get();
       if($request->pdf_download=='pdf_download'){
        $pdf = PDF::loadView('report.sell.pdf.sell_report_customer',compact('data','start','end','company'));
        return $pdf->download('sell_report_customer.pdf');
       }else{
           return view('report.sell.sell_report_customer',compact('data','start','end','company'));
       }
    }

       //sell report show all
    public function  saleReportShowAll(Request $request){
        $start=$request->start; 
        $end=$request->end; 
        $company=Company::first();
        $count=Sale::whereBetween('sale_date',[$start,$end])->count();
       if($count==0){
         session()->flash("error","No Data Found");
         return back();
       }
       $data=Sale::whereBetween('sale_date',[$start,$end])->with('customers','user')->orderBy('sales.id','DESC')->get();
       if($request->pdf_download=='pdf_download'){
        $pdf = PDF::loadView('report.sell.pdf.sell_report',compact('data','start','end','company'));
        return $pdf->download('sell_report.pdf');
       }else{
           return view('report.sell.sale_report_date_wise',compact('data','start','end','company'));
       }
    }


}
