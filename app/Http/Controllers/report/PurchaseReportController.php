<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\supplier\Supplier;
use App\purchase\Purchase;
use App\company\Company;
use PDF;

class PurchaseReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //purchase report view
    public function purchaseReport(){
       $supplier=Supplier::where('status',1)->orderBy('id','DESC')->get(); 
       return view('report.purchase.index',compact('supplier'));
    }

     //purchase report show supplier
    public function purchaseReportShowSupplier(Request $request){
       $start=$request->start; 
       $end=$request->end; 
       $company=Company::first();
       $count=Purchase::where('supplier_id',$request->supplier_id)->whereBetween('purchase_date',[$start,$end])->count();
       if($count==0){
         session()->flash("error","No Data Found");
         return back();
       }
       $data=Purchase::where('supplier_id',$request->supplier_id)->whereBetween('purchase_date',[$start,$end])->with('suppliers','user')->get();
       if($request->pdf_download=='pdf_download'){
        $pdf = PDF::loadView('report.purchase.pdf.purchase_report_supplier',compact('data','start','end','company'));
        return $pdf->download('purchase_report_supplier.pdf');
       }else{
           return view('report.purchase.purchase_report_supplier',compact('data','start','end','company'));
       }
    }

       //purchase report show all
    public function  purchaseReportShowAll(Request $request){
        $start=$request->start; 
        $end=$request->end; 
        $company=Company::first();
        $count=Purchase::whereBetween('purchase_date',[$start,$end])->count();
       if($count==0){
         session()->flash("error","No Data Found");
         return back();
       }
       $data=Purchase::whereBetween('purchase_date',[$start,$end])->with('suppliers','user')->orderBy('purchases.id','DESC')->get();
       if($request->pdf_download=='pdf_download'){
        $pdf = PDF::loadView('report.purchase.pdf.purchase_report',compact('data','start','end','company'));
        return $pdf->download('purchase_report.pdf');
       }else{
           return view('report.purchase.purchase_report_date_wise',compact('data','start','end','company'));
       }
    }


}
