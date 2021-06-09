<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\supplier\Supplier;
use App\purchase\Purchase;
use App\supplier\SupplierPayment;

class SupplierPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=Supplier::where('status',1)->get();
        return view('purchase.supplier_payment',compact('supplier'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $start=$request->start;
        $end=$request->end;
        $count=Purchase::where('supplier_id',$request->supplier_id)->whereBetween('purchase_date',[$start,$end])->where('total_due','>',0)->count();
        if($count==0){
           session()->flash("error","No payment due found");
           return redirect(route('payment-supplier.index'));
        }
        $data=Purchase::where('supplier_id',$request->supplier_id)->whereBetween('purchase_date',[$start,$end])->with('user','suppliers')->where('total_due','>',0)->get();
        return view('purchase.supplier_payment_info',compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function payment(Request $request){
       for($i=0;$i<count($request->purchase_invoice_id);$i++){
           //data insert in supplier payment table    
             $store=new SupplierPayment;
             $store->purchase_invoice_id=$request->purchase_invoice_id[$i];
             $store->supplier_id=$request->supplier_id[$i];
             $store->payment_date=$request->payment_date;
             $store->total_purchase=$request->total_purchase[$i];
             $store->total_payment=$request->total_payment[$i]+$request->payment_amount[$i];
             $store->payment_amount=$request->payment_amount[$i];
             $store->payment_by=auth()->user()->id;
             $store->payment_method=$request->payment_method;
             $store->payment_status=$request->payment_status[$i];
             $store->save();

             $current_amount=SupplierPayment::where('id',$store->id)->where('supplier_id',$request->supplier_id[$i])->first();
             $total_current_due=$current_amount->total_purchase-$current_amount->total_payment;
             SupplierPayment::where('id',$store->id)->update([
              'total_due'=>$total_current_due,
            ]);

            //data update in purchase table 
            $purchase_data=Purchase::where('id',$request->purchase_invoice_id[$i])->first();
            $total_payment=$purchase_data->total_payment+$request->payment_amount[$i];
            Purchase::where('id',$purchase_data->id)->update([
              'total_payment'=>$total_payment,
              'status'=>$request->status[$i],
              'payment_status'=>$request->payment_status[$i],
            ]);

            $current_payment_amount=Purchase::where('id',$request->purchase_invoice_id[$i])->first();
            $total_due=$current_payment_amount->total_price-$current_payment_amount->total_payment;
             Purchase::where('id',$purchase_data->id)->update([
              'total_due'=>$total_due,
            ]);
       }
         session()->flash("success","Payment has been completed");
         return redirect(route('payment-supplier.index'));
    }
}
