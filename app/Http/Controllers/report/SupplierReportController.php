<?php

namespace App\Http\Controllers\report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\supplier\Supplier;
use App\purchase\Purchase;
use App\company\Company;
use App\supplier\SupplierPayment;

class SupplierReportController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $supplier=Supplier::where('status',1)->orderBy('id','DESC')->get();
        return view('report.supplier.index',compact('supplier'));
    }

    public function supplierReport(Request $request){
       $type=$request->report_type;
       $start=$request->start;
       $end=$request->end;
       $company=Company::first();
       if($type==1){
            $count=Purchase::where('supplier_id',$request->supplier_id)->whereBetween('purchase_date',[$start,$end])->count();
            if($count==0){
              session()->flash("error","No purchase data found");
              return back();
            }
            $data=Purchase::where('supplier_id',$request->supplier_id)->whereBetween('purchase_date',[$start,$end])->with('user','suppliers')->get();
            return view('report.supplier.supplier_purchase_report',compact('data','company','start','end'));
        }
            $count=SupplierPayment::where('supplier_id',$request->supplier_id)->whereBetween('payment_date',[$start,$end])->count();
            if($count==0){
              session()->flash("error","No Payment history found");
              return back();
            }
            $payment_item=[];
            $data=SupplierPayment::where('supplier_id',$request->supplier_id)->whereBetween('payment_date',[$start,$end])->with('suppliers')->groupBy('purchase_invoice_id')->get();
            foreach($data as $key=>$items){
                $payment_item[$items->purchase_invoice_id]=SupplierPayment::where('supplier_id',$items->supplier_id)->where('purchase_invoice_id',$items->purchase_invoice_id)->whereBetween('payment_date',[$start,$end])->with('user')->get()->toArray();
            }




            return view('report.supplier.supplier_payment_report',compact('data','company','start','end','payment_item'));
       }
}
