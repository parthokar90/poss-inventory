<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\product\Product;
use App\warehouse\Warehouse;
use App\product\ProductWarehouse;
use App\varients\Varients;
use App\varients\ProductVarient;
use App\brand\Brand;
use App\category\Category;
use App\units\Units;
use App\tax\Taxrate;
use DB;
use App\Http\Requests\ProductValidationRequest;

class ProductController extends Controller
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
    public function index()
    {
        $list=Product::orderBy('id','DESC')->with('category','brand')->simplePaginate(10);
        return view('product.index',compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouse=Warehouse::where('status',1)->orderBy('id','DESC')->get();
        $variants=Varients::where('status',1)->orderBy('id','DESC')->get();
        $brands=Brand::where('status',1)->orderBy('id','DESC')->get();
        $categorys=Category::where('status',1)->where('parent_id',0)->orderBy('id','DESC')->get();
        $units=Units::where('status',1)->orderBy('id','DESC')->get();
        $taxrates=Taxrate::where('status',1)->orderBy('id','DESC')->get();
        return view('product.create',compact('warehouse','variants','brands','categorys','units','taxrates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidationRequest $request)
    {
        // inset product table 
        $image_name=null;
        if($request->hasFile('product_image')){
             $image_name = time().'.'.$request->product_image->getClientOriginalExtension();
             $request->product_image->move(('product_image/'), $image_name);
        }
        $store=new Product;
        $store->product_type=$request->product_type;
        $store->product_name=$request->product_name;
        $store->product_slug=lcfirst($request->product_name);
        $store->product_cost=$request->product_cost;
        $store->product_price=$request->product_price;
        $store->product_alert_qty=$request->product_alert_qty;
        $store->product_weight=$request->product_weight;
        $store->product_image=$image_name;
        $store->tax_rate_id=$request->tax_rate_id;
        $store->product_brand=$request->product_brand;
        $store->product_cat_id=$request->product_cat_id;
        $store->product_subcat_id=$request->product_subcat_id;
        $store->product_unit_id=$request->product_unit_id;
        $store->product_details=$request->product_details;
        $store->save();
        // last insert id
        $id=$store->id;
        Product::where('id',$id)->update([
         'product_code'=>'code'.'-'.$id,
        ]);
        //check if variant is found
          if(!empty($request->varient_id)){
            for($i=0;$i<count($request->varient_id);$i++){
                 if($request->variant_qty[$i]==''){
                        $qtyy=0;
                    }else{
                        $qtyy=$request->variant_qty[$i];
                    }
             $store=new ProductVarient;
             $store->product_id=$id;
             $store->warehouse_id=$request->variant_warehouse_id[$i];
             $store->varient_id=$request->varient_id[$i];
             $store->price_addition=$request->price_addition[$i];
             $store->qty=$qtyy;
             $store->alert_qty=$request->product_alert_qty;
             $store->variant_rack=$request->variant_rack[$i];
             $store->status=1;
             $store->save();
             $store_were=new ProductWarehouse;
             $store_were->product_id=$id;
             $store_were->warehouse_id=$request->variant_warehouse_id[$i];
             $store_were->varient_id=$request->varient_id[$i];
             $store_were->qty=$qtyy;
             $store_were->alert_qty=$request->product_alert_qty;
             $store_were->racks=$request->variant_rack[$i];
             $store_were->save();
          }
        }else{

         $store=new ProductWarehouse;
         $store->product_id=$id;
         $store->warehouse_id=$request->warehouse_id;
         $store->qty=100;
         $store->alert_qty=$request->product_alert_qty;
         $store->racks="No Rack";
         $store->save();
        }
        session()->flash("success","Information saved Successfully");
        return redirect(route('product.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit=Product::find($id);
        $warehouse=Warehouse::where('status',1)->orderBy('id','DESC')->get();
        $sub_category=Category::where('id',$edit->product_subcat_id)->first();
        $variants=Varients::where('status',1)->orderBy('id','DESC')->get();
        $brands=Brand::where('status',1)->orderBy('id','DESC')->get();
        $categorys=Category::where('status',1)->where('parent_id',0)->orderBy('id','DESC')->get();
        $units=Units::where('status',1)->orderBy('id','DESC')->get();
        $taxrates=Taxrate::where('status',1)->orderBy('id','DESC')->get();
        $item_warehouse=ProductWarehouse::where('product_id',$id)->get();
        $item_varient=ProductVarient::where('product_id',$id)->get();
        return view('product.edit',compact('warehouse','variants','brands','categorys','units','taxrates','edit','item_warehouse','item_varient','sub_category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductValidationRequest $request, $id)
    {
        // update product table
        if($request->product_image==''){
           $image_name=$request->d_logo;
        }else{
          $image_name = time().'.'.$request->product_image->getClientOriginalExtension();
          $request->product_image->move(('product_image/'), $image_name);
        }
        Product::where('id',$id)->update([
            'product_type'=>$request->product_type,
            'product_name'=>$request->product_name,
            'product_slug'=>lcfirst($request->product_name),
            'product_cost'=>$request->product_cost,
            'product_price'=>$request->product_price,
            'product_alert_qty'=>$request->product_alert_qty,
            'product_weight'=>$request->product_weight,
            'product_image'=>$image_name,
            'tax_rate_id'=>$request->tax_rate_id,
            'product_brand'=>$request->product_brand,
            'product_cat_id'=>$request->product_cat_id,
            'product_subcat_id'=>$request->product_subcat_id,
            'product_unit_id'=>$request->product_unit_id,
            'product_details'=>$request->product_details,
        ]);

        // update warehouse table
        ProductWarehouse::where('product_id',$id)->delete();
        // update varient table
        ProductVarient::where('product_id',$id)->delete();
        if($request->varient_id!=null){
            for($i=0;$i<count($request->varient_id);$i++){
             $store=new ProductVarient;
             $store->product_id=$id;
             $store->warehouse_id=$request->warehouse_ids[$i];
             $store->varient_id=$request->varient_id[$i];
             $store->price_addition=$request->price_addition[$i];
             $store->qty=$request->qty[$i];
             $store->alert_qty=$request->product_alert_qty;
             $store->variant_rack=$request->racks[$i];
             $store->status=$request->status[$i];
             $store->save();
             $were_store=new ProductWarehouse;
             $were_store->product_id=$id;
             $were_store->warehouse_id=$request->warehouse_ids[$i];
             $were_store->varient_id=$request->varient_id[$i];
             $were_store->qty=$request->qty[$i];
             $were_store->alert_qty=$request->product_alert_qty;
             $were_store->racks=$request->racks[$i];
             $were_store->save();
          }
        }else{
            if($request->qty!=null){
            for($i=0;$i<count($request->warehouse_id);$i++){
                $store=new ProductWarehouse;
                $store->product_id=$id;
                $store->warehouse_id=$request->warehouse_id[$i];
                $store->qty=$request->qty[$i];
                $store->alert_qty=$request->product_alert_qty;
                $store->racks=$request->racks[$i];
                $store->save();
            }
          }
        }
        session()->flash("success","Information update Successfully");
        return redirect(route('product.index'));
    }

    //search product
    public function searchProduct(Request $request){
       $count=Product::where('product_name','LIKE',"%{$request->search}%")->orWhere('product_code','LIKE',"%{$request->search}%")->count();
       if($count==0){
        session()->flash("error","No Product found");
        return redirect(route('product.index'));
       }
       $list=Product::where('product_name','LIKE',"%{$request->search}%")->orWhere('product_code','LIKE',"%{$request->search}%")->orderBy('id','DESC')->simplePaginate(10);
       return view('product.index',compact('list'));
    }

    //product ajax request
    public function ajaxProduct($id){
      $product=Product::find($id);
      $count=DB::table('sell_product')->where('product_id',$id)->count();
      if($count>0){
          $qty=DB::table('sell_product')->where('product_id',$id)->sum('quantity')+1;
          DB::table('sell_product')->where('product_id',$id)->update([
            'product_id' =>$id,
            'price' =>$product->product_price,
            'quantity' =>$qty,
            'sub_total' =>$product->product_price*$qty,
        ]); 
      }else{
        DB::table('sell_product')->insert([
            'product_id' =>$id,
            'price' =>$product->product_price,
            'quantity' =>1,
            'sub_total' =>$product->product_price*1,
        ]); 
      }
 
      $data=DB::table('sell_product')
      ->leftjoin('products','products.id','=','sell_product.product_id')
      ->select('products.product_name','sell_product.*')
      ->groupBy('id')
      ->get();
      $list = $data->map(function($item, $key) {
                            return [
                                'id' => $item->id,
                                'product_name' => $item->product_name,
                                'price' => number_format($item->price),
                                'quantity' => $item->quantity,
                                'sub_total' => number_format($item->sub_total),
                            ];
                        });
     return response()->json($list);
    }

    //total item
    public function ajaxProductItem(){
         $data=DB::table('sell_product')->count();
         return response()->json($data);
    }

    //total order
    public function ajaxProductTotal(){
         $data=DB::table('sell_product')->sum('sub_total');
         $sub_total=number_format($data);
         return response()->json($sub_total);
    }

       //total order
    public function ajaxProductTotalVatDiscount(){
         $vat=DB::table('sale_vat_temps')->sum('vat_amount');
         $discount=DB::table('sale_discount_temps')->sum('discount_amount');
         $data=DB::table('sell_product')->sum('sub_total');
         $total=($data+$vat)-$discount;
         $number_format=number_format($total);
         return response()->json($number_format);
    }

    //item update
    public function ajaxItemUpdate($id,$input){
       $select=DB::table('sell_product')->where('id',$id)->first();
       DB::table('sell_product')->where('id',$id)->update([
           'quantity'=>$input,
           'sub_total'=>$select->price*$input,
       ]);
       return response()->json('success');
    }

    //all item 
    public function ajaxProductItemAll(){
        $data=DB::table('sell_product')
      ->leftjoin('products','products.id','=','sell_product.product_id')
      ->select('products.product_name','sell_product.*')
      ->groupBy('id')
      ->get();
      $list = $data->map(function($item, $key) {
                            return [
                                'id' => $item->id,
                                'product_name' => $item->product_name,
                                'price' => number_format($item->price),
                                'quantity' => $item->quantity,
                                'sub_total' => number_format($item->sub_total),
                            ];
                        });
     return response()->json($list);
    }

    //item remove
    public function ajaxItemRemove($id){
        $data=DB::table('sell_product')->where('id',$id)->delete();
        return response()->json($data);
    }

    //item vat
    public function ajaxItemVat($input){
        $total_order=DB::table('sell_product')->sum('sub_total');
        $vat_amount=($total_order/100)*$input;
        DB::table('sale_vat_temps')->delete();
        DB::table('sale_vat_temps')->insert([
          'vat_amount'=>$vat_amount
        ]);
    }

    //item discount
    public function ajaxItemDiscount($input){
        $total_order=DB::table('sell_product')->sum('sub_total');
        $discount_amount=($total_order/100)*$input;
        DB::table('sale_discount_temps')->delete();
        DB::table('sale_discount_temps')->insert([
          'discount_amount'=>$discount_amount
        ]);
    }


}
