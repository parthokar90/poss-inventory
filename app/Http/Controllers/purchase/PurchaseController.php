<?php

namespace App\Http\Controllers\purchase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\warehouse\Warehouse;
use App\supplier\Supplier;
use App\product\ProductWarehouse;
use App\product\Product;
use App\varients\ProductVarient;
use App\varients\Varients;
use App\Tax\Taxrate;
use App\purchase\Purchase;
use App\purchase\PurchaseItem;
use App\purchase\TemporaryPurchase;
use App\purchase\PurchaseDiscountTemp;
use App\purchase\PurchaseVatTemp;
use DB;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          $query=$request->search_item;
          if($query=='all_search'){
               $count=Purchase::where('id',$request->search)->orWhere('status','LIKE',"%$request->search%")->orderBy('id','DESC')->count();
               if($count==0){
                  session()->flash("error","No Item Found");
                  return redirect(route('purchase.index'));
               } 
               $supplier=Supplier::where('status',1)->orderBy('id','DESC')->get();
               $list=Purchase::where('id',$request->search)->orWhere('status','LIKE',"%$request->search%")->orderBy('id','DESC')->with('user','suppliers')->simplePaginate(10);
               return view('purchase.index',compact('list','supplier'));
           }
           if($query=='supplier_search'){
               $count=Purchase::where('supplier_id',$request->supplier_id)->where('purchase_date',$request->purchase_date)->orderBy('id','DESC')->count();
               if($count==0){
                   session()->flash("error","No Item Found");
                   return redirect(route('purchase.index')); 
               } 
               $supplier=Supplier::where('status',1)->orderBy('id','DESC')->get();
               $list=Purchase::where('supplier_id',$request->supplier_id)->where('purchase_date',$request->purchase_date)->orderBy('id','DESC')->with('user','suppliers')->simplePaginate(10);
               return view('purchase.index',compact('list','supplier'));
           }
           if($query=='date_search'){
             $start=$request->start;
             $end=$request->end;
              $count=Purchase::whereBetween('purchase_date',[$start,$end])->orderBy('id','DESC')->count();
               if($count==0){
                  session()->flash("error","No Item Found");
                  return redirect(route('purchase.index'));
               } 
               $supplier=Supplier::where('status',1)->orderBy('id','DESC')->get();
               $list=Purchase::whereBetween('purchase_date',[$start,$end])->orderBy('id','DESC')->with('user','suppliers')->simplePaginate(10);
               return view('purchase.index',compact('list','supplier'));
           }

          $supplier=Supplier::where('status',1)->orderBy('id','DESC')->get();
          $list=Purchase::orderBy('id','DESC')->with('user','suppliers')->simplePaginate(10);
          return view('purchase.index',compact('list','supplier'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $supplier=Supplier::where('status',1)->orderBy('id','DESC')->get();
          $product=Product::orderBy('id','DESC')->get();
          $data=TemporaryPurchase::orderBy('id','DESC')
         ->groupBy('product_id')
         ->get();
          $price=TemporaryPurchase::sum('ac_price');
          $vat=PurchaseVatTemp::sum('vat_amount');
          $discount=PurchaseDiscountTemp::sum('discount_amount');
          $vat_amount=$price/100*$vat;
          $discount_amount=$price/100*$discount;
          $total_payable=$price+$vat_amount-$discount_amount;
          return view('purchase.create',compact('supplier','product','data','vat','discount','vat_amount','discount_amount','total_payable'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //update purchase quantity
          if($request->quantity_update=='quantity_update'){
             for($i=0;$i<count($request->update_id);$i++){
                 $data=DB::table('temporary_purchases')->where('id',$request->update_id[$i])->first();
                 $price=$data->product_price+$data->varient_price;
                   DB::table('temporary_purchases')->where('id',$request->update_id[$i])->update([
                     'input_qty' =>$request->qtyy[$i],
                     'ac_price' => $price*$request->qtyy[$i],
                   ]);
                 }
              session()->flash("success","Quantity has been update");
              return back();
            }
            //data store in purchase table
             $vat=PurchaseVatTemp::sum('vat_amount');
             $discount=PurchaseDiscountTemp::sum('discount_amount');
             if($vat==''){
                 $vat=0;
              }else{
                 $vat=$vat;
              }
             if($discount==''){
                 $discount=0;
              }else{
                  $discount=$discount;
              }
              $total_vat=($request->total_price/100)*$vat;
              $total_discount=($request->total_price/100)*$discount;
              $total_purchase=$request->total_price+$total_vat-$total_discount;
              $store=new Purchase;
              $store->supplier_id=$request->supplier_id;
              $store->purchase_date=$request->purchase_date;
              $store->purchased_by=auth()->user()->id;
              $store->purchase_vat=$vat;
              $store->purchase_vat_amount=$total_vat;
              $store->purchase_discount=$discount;
              $store->purchase_discount_amount=$total_discount;
              $store->purchase_note=$request->purchase_note;
              $store->status=$request->status;
              $store->payment_status=$request->payment_status;
              $store->total_price=$total_purchase;
              $store->total_payment=$request->purchase_payment;
              $store->total_due=$total_purchase-$request->purchase_payment;
              $store->save();
              // multiple data store in purchase item table
              $item_data=TemporaryPurchase::all();
              foreach($item_data as $key=>$data){
                $item=new PurchaseItem;
                $item->purchase_id=$store->id;
                $item->supplier_id=$request->supplier_id;
                $item->purchase_date=$request->purchase_date;
                $item->purchased_by=auth()->user()->id;
                $item->warehouse_id=$data->warehouse_id;
                $item->warehouse=$data->warehouse;
                $item->product_id=$data->product_id;
                $item->product=$data->product;
                $item->product_price=$data->product_price;
                $item->code=$data->code;
                $item->cost=$data->cost;
                $item->tax=$data->tax;
                $item->tax_rate_id=$data->tax_rate_id;
                $item->tax_rate_type=$data->tax_rate_type;
                $item->varient_id=$data->varient_id;
                $item->varient=$data->varient;
                $item->varient_price=$data->varient_price;
                $item->total_qty=$request->qtyy[$key];
                $item->sub_total=$request->sub_total_price[$key];
                $item->save();
            }        
            // stock increase from warehouse
             for($i=0;$i<count($request->qtyy);$i++){
                if($request->variantss_id[$i]!=null){
                    $variants=DB::table('product_warehouses')
                    ->where('product_id',$request->pro_id[$i])
                    ->where('varient_id',$request->variantss_id[$i])
                    ->first();
                    if(isset($variants)){
                    $vqty=$variants->qty+$request->qtyy[$i];
                    DB::table('product_warehouses')
                    ->where('product_id',$request->pro_id[$i])
                    ->where('varient_id',$request->variantss_id[$i])
                    ->update([
                      'qty'=> $vqty
                    ]);
                    DB::table('product_varients')
                    ->where('product_id',$request->pro_id[$i])
                    ->where('varient_id',$request->variantss_id[$i])
                    ->update([
                      'qty'=> $vqty
                    ]);
                  }
                }
              if($request->variantss_id[$i]==null){
                    $ware=DB::table('product_warehouses')
                    ->where('product_id',$request->pro_id[$i])
                    ->where('warehouse_id',$request->ware_id[$i])
                    ->first();
                    if(isset($ware)){
                      $wqty=$ware->qty+$request->qtyy[$i];
                      DB::table('product_warehouses')
                     ->where('product_id',$request->pro_id[$i])
                     ->where('warehouse_id',$request->ware_id[$i])
                     ->update([
                         'qty'=> $wqty
                     ]);
                    }
                }   
            }
            //after insert data in purchase item table then delete from purchase temporary table
            DB::table('temporary_purchases')->delete();
            PurchaseDiscountTemp::truncate();
            PurchaseVatTemp::truncate();
            session()->flash("success","purchased completed successfully");
            return back();
      }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $invoice_details=Purchase::where('id',$id)->with('suppliers','user')->first();
          $sub_total=PurchaseItem::where('purchase_id',$id)->sum('sub_total');
          $data=Purchase::where('id',$id)->with('suppliers','user')->get();
          return view('purchase.purchase_show',compact('data','sub_total','invoice_details'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
          $data=Purchase::where('id',$id)->with('suppliers','user')->get();
          $invoice_details=Purchase::where('id',$id)->with('suppliers','user')->first();
          $sub_total=PurchaseItem::where('purchase_id',$id)->sum('sub_total');
          return view('purchase.purchase_edit',compact('data','sub_total','invoice_details'));
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
         $qty=$request->qty;
         if($qty==null){
            session()->flash("error","Enter Quantity");
            return back();
         }
         $item=PurchaseItem::where('id',$id)->first();
         if($request->qty_plus=='qty_plus'){
             $stock=$item->total_qty+$qty;
             PurchaseItem::where('id',$id)->update([
                'total_qty'=>$stock 
             ]);
           //check item has variant or not
           if($item->varient_id==''){
              $current_stock=ProductWarehouse::where('product_id',$item->product_id)
              ->where('warehouse_id',$item->warehouse_id)
              ->sum('qty');
              $update_stock=$current_stock+$qty;
              ProductWarehouse::where('product_id',$item->product_id)
              ->where('warehouse_id',$item->warehouse_id)
              ->update([
                'qty' =>$update_stock
              ]);
            }else{
              $current_stock=ProductWarehouse::where('product_id',$item->product_id)
              ->where('varient_id',$item->varient_id)
              ->sum('qty');
              $update_stock=$current_stock+$qty;
              ProductWarehouse::where('product_id',$item->product_id)
              ->where('varient_id',$item->varient_id)
              ->update([
                'qty' =>$update_stock
              ]);

              ProductVarient::where('product_id',$item->product_id)
              ->where('varient_id',$item->varient_id)
              ->update([
                'qty' =>$update_stock
              ]);
              
            }
         } 
         if($request->qty_minus=='qty_minus'){
           //check current quantity is greater than request quantity
           if($qty>$item->total_qty){
               session()->flash("error","You can't returned more than".$item->total_qty. "Quantity");
               return back();
           }
            $stock=$item->total_qty-$qty;
            PurchaseItem::where('id',$id)->update([
              'total_qty'=>$stock 
           ]);
            //check item has variant or not
           if($item->varient_id==''){
                $current_stock=ProductWarehouse::where('product_id',$item->product_id)
               ->where('warehouse_id',$item->warehouse_id)
               ->sum('qty');
               $update_stock=$current_stock-$qty;
               ProductWarehouse::where('product_id',$item->product_id)
               ->where('warehouse_id',$item->warehouse_id)
               ->update([
                  'qty' =>$update_stock
               ]);
            }else{
               $current_stock=ProductWarehouse::where('product_id',$item->product_id)
              ->where('varient_id',$item->varient_id)
              ->sum('qty');
              $update_stock=$current_stock-$qty;
              ProductWarehouse::where('product_id',$item->product_id)
              ->where('varient_id',$item->varient_id)
              ->update([
                'qty' =>$update_stock
              ]);

              ProductVarient::where('product_id',$item->product_id)
              ->where('varient_id',$item->varient_id)
              ->update([
                'qty' =>$update_stock
              ]);
            }
         }


       // calculate total purchase price and update purchase table 
         $current_qty=PurchaseItem::where('id',$id)->sum('total_qty');
         $current_p_price=PurchaseItem::where('id',$id)->sum('product_price');
         $current_v_price=PurchaseItem::where('id',$id)->sum('varient_price');
         $current_price=$current_p_price+$current_v_price;
         $sub_total=$current_price*$current_qty;
         PurchaseItem::where('id',$id)->update([
          'sub_total'=>$sub_total
         ]);
         $invoice_total=PurchaseItem::where('purchase_id',$request->invoice_id)->sum('sub_total');
         $discount=Purchase::where('id',$request->invoice_id)->sum('purchase_discount');
         $vat=Purchase::where('id',$request->invoice_id)->sum('purchase_vat');
         $invoice_vat=$invoice_total/100*$vat;
         $invoice_discount=$invoice_total/100*$discount;
         $invoice_payment=Purchase::where('id',$request->invoice_id)->sum('total_payment');
         $grand_total=($invoice_total+$invoice_vat)-$invoice_discount;
         $due=$grand_total-$invoice_payment;
         Purchase::where('id',$request->invoice_id)->update([
            'order_total_price'=>$grand_total,
            'total_price'=>$grand_total,
            'total_due'=>$due,
            'purchase_vat_amount'=>$invoice_vat,
            'purchase_discount_amount'=>$invoice_discount,
         ]);

         if($request->qty_plus=='qty_plus'){
            session()->flash("success","Quantity has been purchased");
            return back();
         }else{
            session()->flash("success","Quantity has been returned");
            return back();
         }
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
  
    // temporary purchase product
    public function purchaseTemp(Request $request){
            $product_id=$request->product_id;
            $data=[];
            //-------- check product id already exists in temporary table ----------\\
            $count=TemporaryPurchase::where('product_id',$product_id)->count();
            if($count>0){
                TemporaryPurchase::where('product_id',$product_id)->delete();
            }
           //-------- check product has varient then data from product varient table----------\\
            $varient_count=ProductVarient::where('product_id',$product_id)->where('status',1)->count();
            if($varient_count>0){ 
                $data=ProductVarient::where('product_varients.product_id',$product_id)
                 ->join('products','products.id','=','product_varients.product_id')
                 ->join('warehouses','warehouses.id','=','product_varients.warehouse_id')
                 ->where('product_varients.status',1)
                 ->get();
            }   
            //-------- if product has no varient then data from product warehouse table----------\\
            else{
                $data=ProductWarehouse::where('product_warehouses.product_id',$product_id)
                ->join('products','products.id','=','product_warehouses.product_id')
                ->join('warehouses','warehouses.id','=','product_warehouses.warehouse_id')
                ->where('warehouses.status',1)
                ->get();
            } 
            //-------- data insert in temporary purchase table----------\\
             foreach($data as $item){
                    $tax_rate=Taxrate::where('id',$item->tax_rate_id)->where('status',1)->first();
                     if(isset($tax_rate)){
                        $tax_id=$tax_rate->id;
                        $tax_type=$tax_rate->type;
                        $tax=$tax_rate->rate;
                    }else{
                        $tax_id=0;
                        $tax_type=0;
                        $tax=0;
                    }
                    $product_varient=ProductVarient::where('product_id',$item->product_id)->where('varient_id',$item->varient_id)->first();
                    if(isset($product_varient)){
                         $varients=Varients::where('id',$product_varient->varient_id)->first();
                         $varient_id=$varients->id;
                         $varient=$varients->varient_name;
                         $varient_price=$product_varient->price_addition;
                    }else{
                         $varient_id='';
                         $varient='';
                         $varient_price=0;
                    }
                    $store=new TemporaryPurchase;
                    $store->product_id=$item->product_id;
                    $store->warehouse=$item->name;
                    $store->warehouse_id=$item->warehouse_id;
                    $store->stock_qty=$item->qty;
                    $store->input_qty=1;
                    $store->product=$item->product_name;
                    $store->product_price=$item->product_price;
                    $store->code=$item->product_code;
                    $store->cost=$item->product_cost;;
                    $store->varient_id=$varient_id;
                    $store->varient=$varient;
                    $store->varient_price=$varient_price;
                    $store->tax_rate_id=$tax_id;
                    $store->tax_rate_type=$tax_type;
                    $store->tax=$tax;
                    $store->ac_price=$item->product_price+$item->price_addition*1;
                    $store->save();
             }
             return back();
       }
     //delete full item
     public function purchaseProductDelete($id){
         PurchaseDiscountTemp::truncate();
         PurchaseVatTemp::truncate();
         TemporaryPurchase::where('product_id',$id)->delete();
         session()->flash("error","Item has been deleted");
         return back();
     } 

     //delete partial item
     public function purchaseItemDelete($id){
         TemporaryPurchase::where('id',$id)->delete();
         session()->flash("error","Item has been deleted");
         return back();
     }   
     
        //discount store
     public function discount(Request $request){
         PurchaseDiscountTemp::truncate();
         $store=new PurchaseDiscountTemp;
         $store->discount_amount=$request->discount;
         $store->save();
         return response()->json('success');
     }

     //vat store 
      public function vat(Request $request){
         PurchaseVatTemp::truncate();
         $store=new PurchaseVatTemp;
         $store->vat_amount=$request->vat;
         $store->save();
         return response()->json('success');
     }

  }

