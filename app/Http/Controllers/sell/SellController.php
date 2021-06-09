<?php

namespace App\Http\Controllers\sell;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\product\Product;
use App\biller\Biller;
use App\warehouse\Warehouse;
use App\product\ProductWarehouse;
use App\tax\Taxrate;
use App\sale\SaleDiscountTemp;
use App\sale\SaleVatTemp;
use App\customer\Customer;
use App\sale\TemprarySaleItem;
use App\sale\Sale;
use App\sale\SaleItem;
use App\varients\ProductVarient;
use DB;

class SellController extends Controller
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
          $start=$request->start;
          $end=$request->end;
          $customer=Customer::where('status',1)->orderBy('id','DESC')->get();
          if($query=='all_search'){
               $count=Sale::where('id',$request->search)->orderBy('id','DESC')->count();
               if($count==0){
                  session()->flash("error","No Item Found");
                  return redirect(route('sales.index'));
               } 
               $list=Sale::where('id',$request->search)->orderBy('id','DESC')->with('user','customers','billers')->paginate(10);
               return view('sell.index',compact('list','customer'));
           }

           if($query=='customer_search'){
               $count=Sale::where('customer_id',$request->customer_id)->where('sale_date',$request->sale_date)->orderBy('id','DESC')->count();
               if($count==0){
                   session()->flash("error","No Item Found");
                   return redirect(route('sales.index'));
               } 
               $list=Sale::where('customer_id',$request->customer_id)->where('sale_date',$request->sale_date)->orderBy('id','DESC')->with('user','customers','billers')->paginate(10);
               return view('sell.index',compact('list','customer'));
           }

           if($query=='date_search'){
                 $count=Sale::whereBetween('sale_date',[$start,$end])->orderBy('id','DESC')->count();
                 if($count==0){
                   session()->flash("error","No Item Found");
                   return redirect(route('sales.index'));
                 } 
                 $list=Sale::whereBetween('sale_date',[$start,$end])->orderBy('id','DESC')->with('user','customers','billers')->paginate(10);
                 return view('sell.index',compact('list','customer'));
           }
          $list=Sale::orderBy('id','DESC')->with('user','customers','billers')->paginate(10);
          return view('sell.index',compact('list','customer'));
    }

    //edit the sale
    public function edit($id){
       $invoice_details=Sale::where('id',$id)->with('customers','user','billers')->first();
       $data=Sale::where('id',$id)->with('customers','user')->get();
       $sub_total=SaleItem::where('sales_id',$id)->sum('sub_total');
       return view('sell.edit',compact('data','invoice_details','sub_total'));
    }

   //show the sale
    public function show($id){
        $invoice_details=Sale::where('id',$id)->with('customers','user','billers')->first();
        $data=Sale::where('id',$id)->with('customers','user')->get();
        $sub_total=SaleItem::where('sales_id',$id)->sum('sub_total');
        return view('sell.show',compact('data','invoice_details','sub_total'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product=Product::orderBy('id','DESC')->get();
        $customer=Customer::where('status',1)->get();
        $biller=Biller::where('status',1)->orderBy('id','DESC')->get();
        $warehouse=Warehouse::where('status',1)->orderBy('id','DESC')->get();
        $data=TemprarySaleItem::orderBy('id','DESC')->get();
        $total_items=TemprarySaleItem::count();
        $total_qty=TemprarySaleItem::sum('input_qty');
        $price=TemprarySaleItem::sum('ac_price');
        $vat=SaleVatTemp::sum('vat_amount');
        $discount=SaleDiscountTemp::sum('discount_amount');
        $vat_amount=$price/100*$vat;
        $discount_amount=$price/100*$discount;
        $total_payable=$price+$vat_amount-$discount_amount;
        DB::table('sell_product')->delete();
        DB::table('sale_vat_temps')->delete();
        DB::table('sale_discount_temps')->delete();
        return view('sell.create',compact('product','biller','warehouse','data','total_items','total_qty','price','vat','discount','vat_amount','discount_amount','total_payable','customer'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // /**
      //      *  check if warehouse is not select stock minus from all.
      //      *  warehouse other wise minus from selected warehouse
      //  */

       //total order
       $totalOrder=DB::table('sell_product')->sum('sub_total');

       //tax amount
       $taxAmount=($totalOrder/100)*$request->tax;

       //discount amount
       $discountAmount=($totalOrder/100)*$request->discount;

       //grand total with tax and discount
       $grandTotal=($totalOrder+$taxAmount)-$discountAmount;

       //total due
       $totalDue=$grandTotal-$request->total_payment;



       //sale insert  
         $sale = new Sale;
         $sale->customer_id=$request->customer_id;
         $sale->sale_date=$request->sale_date;
         $sale->sale_vat=$request->tax;
         $sale->sale_vat_amount=$taxAmount;
         $sale->sale_discount=$request->discount;
         $sale->sale_discount_amount=$discountAmount;
         $sale->sale_note=$request->sale_note;
         $sale->sale_by=auth()->user()->id;
         $sale->sale_total_price=$totalOrder;
         $sale->total_price=$grandTotal;
         $sale->total_payment=$request->total_payment;
         $sale->total_due=$totalDue;
         $sale->payment_method=$request->payment_method;
         $sale->status=1;
         $sale->save();


         //sale item insert
         $sellItem=DB::table('sell_product')
         ->leftjoin('product_warehouses','product_warehouses.product_id','=','sell_product.product_id')
         ->leftjoin('products','products.id','=','sell_product.product_id')
         ->leftjoin('warehouses','warehouses.id','=','product_warehouses.warehouse_id')
         ->select('sell_product.quantity','sell_product.sub_total','warehouses.id as warehouse_id','warehouses.name as warehouse','products.id as product_id','products.product_name as product','products.product_price as product_price','products.product_code as code','products.product_cost as cost')
         ->get();
         foreach($sellItem as $item){
                $store=new SaleItem;
                $store->sales_id=$sale->id;
                $store->customer_id=$request->customer_id;
                $store->sales_date=$request->sales_date;
                $store->sales_by=auth()->user()->id;
                $store->warehouse_id=$item->warehouse_id;
                $store->warehouse=$item->warehouse;
                $store->product_id=$item->product_id;
                $store->product=$item->product;
                $store->product_price=$item->product_price;
                $store->code=$item->code;
                $store->cost=$item->cost;
                $store->total_qty=$item->quantity;
                $store->sub_total=$item->sub_total;
                $store->save();
         }

         session()->flash("success","Information saved Successfully");
         return redirect(route('sales.index'));

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
         TemprarySaleItem::where('id',$id)->update([
             'input_qty' =>$request->input_qty,
         ]);
         $data=TemprarySaleItem::where('id',$id)->first();
         $regular_price=$data->product_price;
         $variant_price=$data->varient_price;
         $price=($regular_price+$variant_price)*$request->input_qty;
         TemprarySaleItem::where('id',$id)->update([
             'ac_price' =>$price,
         ]);
         return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TemprarySaleItem::where('id',$id)->delete();
        return back();
    }

    //warehouse product ajax
    public function warehouse_product($id){
      $data=ProductWarehouse::where('warehouse_id',$id)->where('qty','>',0)
      ->join('warehouses','warehouses.id','=','product_warehouses.warehouse_id')  
      ->join('products','products.id','=','product_warehouses.product_id')  
      ->select('products.id','products.product_name')
      ->groupBy('product_id')
      ->get();
      return response()->json($data);
    }

    //vat and discount temporary table
    public function vat_discount(Request $request){
       if($request->vat=='vat'){
         SaleVatTemp::truncate();
         $store=new SaleVatTemp;
         $store->vat_amount=$request->vat_percent;
         $store->save();
         return back();
       }
      if($request->discount=='discount'){
         SaleDiscountTemp::truncate();
         $store=new SaleDiscountTemp;
         $store->discount_amount=$request->discount_percent;
         $store->save();
         return back();
       }
    }

    // sale final submit 
    public function saleFinal(Request $request){

         // data store in sale table
         $vat=SaleVatTemp::sum('vat_amount');
         $discount=SaleDiscountTemp::sum('discount_amount');
         $price=TemprarySaleItem::sum('ac_price');
         $vat=SaleVatTemp::sum('vat_amount');
         $discount=SaleDiscountTemp::sum('discount_amount');
         $total_vat=$price/100*$vat;
         $total_discount=$price/100*$discount;
         $total_purchase=$price+$total_vat-$total_discount;
         $store=new Sale;
         $store->customer_id=$request->customer_id;
         $store->biller_id=$request->biller_id;
         $store->sale_date=$request->sale_date;
         $store->sale_by=auth()->user()->id;
         $store->sale_vat=$vat;
         $store->sale_vat_amount=$total_vat;
         $store->sale_discount=$discount;
         $store->sale_discount_amount=$total_discount;
         $store->sale_note=$request->sale_note;
         $store->sale_total_price=$total_purchase;
         $store->total_price=$total_purchase;
         $store->total_payment=$request->total_payment;
         $store->total_due=$total_purchase-$request->total_payment;
         $store->payment_method=$request->payment_method;
         $store->status=1;
         $store->save();

        // multiple data store in sale item table
        $item_data=TemprarySaleItem::all();
              foreach($item_data as $key=>$data){
                $item=new SaleItem;
                $item->sales_id=$store->id;
                $item->customer_id=$request->customer_id;
                $item->biller_id=$request->biller_id;
                $item->sales_date=$request->sale_date;
                $item->sales_by=auth()->user()->id;
                $item->warehouse_id=$data->warehouse_id;
                $item->warehouse=$data->warehouse;
                $item->product_id=$data->product_id;
                $item->product=$data->product;
                $item->product_price=$data->product_price;
                $item->code=$data->code;
                $item->cost=$data->cost;
                $item->tax_rate_id=$data->tax_rate_id;
                $item->tax_rate_type=$data->tax_rate_type;
                $item->tax=$data->tax;
                $item->varient_id=$data->varient_id;
                $item->varient=$data->varient;
                $item->varient_price=$data->varient_price;
                $item->total_qty=$data->input_qty;
                $item->sub_total=($data->product_price+$data->varient_price)*$data->input_qty;
                $item->save();

                // stock decrement from warehouse
                if($data->varient_id!=null){
                    $variants=DB::table('product_warehouses')
                    ->where('product_id',$data->product_id)
                    ->where('varient_id',$data->varient_id)
                    ->first();
                    if(isset($variants)){
                        $vqty=$variants->qty-$data->input_qty;
                          DB::table('product_warehouses')
                           ->where('product_id',$data->product_id)
                            ->where('varient_id',$data->varient_id)
                         ->update([
                             'qty'=> $vqty
                         ]);
                          DB::table('product_varients')
                          ->where('product_id',$data->product_id)
                          ->where('varient_id',$data->varient_id)
                         ->update([
                             'qty'=> $vqty
                         ]);
                        }
                  }
               if($data->varient_id==null){
                    $ware=DB::table('product_warehouses')
                    ->where('product_id',$data->product_id)
                    ->where('warehouse_id',$data->warehouse_id)
                    ->first();
                    if(isset($ware)){
                      $wqty=$ware->qty-$data->input_qty;
                      DB::table('product_warehouses')
                     ->where('product_id',$data->product_id)
                     ->where('warehouse_id',$data->warehouse_id)
                     ->update([
                         'qty'=> $wqty
                     ]);
                    }
                }  
               // stock decrement from warehouse


            }      
            //after insert data in sale item table then delete from sale temporary table
            TemprarySaleItem::truncate();
            SaleVatTemp::truncate();
            SaleDiscountTemp::truncate();
            session()->flash("success","Sale has been completed successfully");
            return back();
    }

     //sale quantity update or return
     public function qtyUpdate(Request $request, $id){
         $qty=$request->qty;
         if($qty==null){
            session()->flash("error","Enter Quantity");
            return back();
         }
          $item=SaleItem::where('id',$id)->first();

         if($request->qty_plus=='qty_plus'){
             $stock=$item->total_qty+$qty;
             SaleItem::where('id',$id)->update([
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

         if($request->qty_minus=='qty_minus'){
           //check current quantity is greater than request quantity
           if($qty>$item->total_qty){
               session()->flash("error","You can't returned more than ".$item->total_qty."Quantity");
               return back();
           }
            $stock=$item->total_qty-$qty;
            SaleItem::where('id',$id)->update([
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

        // calculate total purchase price and update purchase table 
         $current_qty=SaleItem::where('id',$id)->sum('total_qty');
         $current_p_price=SaleItem::where('id',$id)->sum('product_price');
         $current_v_price=SaleItem::where('id',$id)->sum('varient_price');
         $current_price=$current_p_price+$current_v_price;
         $sub_total=$current_price*$current_qty;
         SaleItem::where('id',$id)->update([
          'sub_total'=>$sub_total
         ]);
         $invoice_total=SaleItem::where('sales_id',$request->invoice_id)->sum('sub_total');
         $vat=Sale::where('id',$request->invoice_id)->sum('sale_vat');
         $discount=Sale::where('id',$request->invoice_id)->sum('sale_discount');
         $invoice_vat=($invoice_total/100)*$vat;
         $invoice_discount=($invoice_total/100)*$discount;
         $invoice_payment=Sale::where('id',$request->invoice_id)->sum('total_payment');
         $grand_total=($invoice_total+$invoice_vat)-$invoice_discount;
         $due=$grand_total-$invoice_payment;
         Sale::where('id',$request->invoice_id)->update([
            'sale_total_price'=>$grand_total,
            'total_price'=>$grand_total,
            'total_due'=>$due,
            'sale_vat_amount'=>$invoice_vat,
            'sale_discount_amount'=>$invoice_discount,
         ]);
         if($request->qty_plus=='qty_plus'){
            session()->flash("success","Quantity has been Sell");
            return back();
         }else{
            session()->flash("success","Quantity has been returned");
            return back();
         }
     }

}
