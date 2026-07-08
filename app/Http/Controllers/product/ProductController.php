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
use App\Services\ProductService;
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
    public function index(ProductService $service)
    {
        return view('product.index', ['list' => $service->getIndex()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ProductService $service)
    {
        return view('product.create', $service->getCreateData());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductValidationRequest $request, ProductService $service)
    {
        try {
            $service->storeProduct($request);
            return redirect()->route('product.index')->with("success", "Saved!");
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, ProductService $service)
    {
        return view('product.edit', $service->getEditData($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductValidationRequest $request, $id, ProductService $service)
    {
        try {
            $service->updateProduct($request, $id);
            return redirect()->route('product.index')->with("success", "Updated!");
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
    }

    //search product
    public function searchProduct(Request $request)
    {
        $count = Product::where('product_name', 'LIKE', "%{$request->search}%")->orWhere('product_code', 'LIKE', "%{$request->search}%")->count();
        if ($count == 0) {
            session()->flash("error", "No Product found");
            return redirect(route('product.index'));
        }
        $list = Product::where('product_name', 'LIKE', "%{$request->search}%")->orWhere('product_code', 'LIKE', "%{$request->search}%")->orderBy('id', 'DESC')->simplePaginate(10);
        return view('product.index', compact('list'));
    }

    //product ajax request
    public function ajaxProduct($id)
    {
        $product = Product::find($id);
        $count = DB::table('sell_product')->where('product_id', $id)->count();
        if ($count > 0) {
            $qty = DB::table('sell_product')->where('product_id', $id)->sum('quantity') + 1;
            DB::table('sell_product')->where('product_id', $id)->update([
                'product_id' => $id,
                'price' => $product->product_price,
                'quantity' => $qty,
                'sub_total' => $product->product_price * $qty,
            ]);
        } else {
            DB::table('sell_product')->insert([
                'product_id' => $id,
                'price' => $product->product_price,
                'quantity' => 1,
                'sub_total' => $product->product_price * 1,
            ]);
        }

        $data = DB::table('sell_product')
            ->leftjoin('products', 'products.id', '=', 'sell_product.product_id')
            ->select('products.product_name', 'sell_product.*')
            ->groupBy('id')
            ->get();
        $list = $data->map(function ($item, $key) {
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
    public function ajaxProductItem()
    {
        $data = DB::table('sell_product')->count();
        return response()->json($data);
    }

    //total order
    public function ajaxProductTotal()
    {
        $data = DB::table('sell_product')->sum('sub_total');
        $sub_total = number_format($data);
        return response()->json($sub_total);
    }

    //total order
    public function ajaxProductTotalVatDiscount()
    {
        $vat = DB::table('sale_vat_temps')->sum('vat_amount');
        $discount = DB::table('sale_discount_temps')->sum('discount_amount');
        $data = DB::table('sell_product')->sum('sub_total');
        $total = ($data + $vat) - $discount;
        $number_format = number_format($total);
        return response()->json($number_format);
    }

    //item update
    public function ajaxItemUpdate($id, $input)
    {
        $select = DB::table('sell_product')->where('id', $id)->first();
        DB::table('sell_product')->where('id', $id)->update([
            'quantity' => $input,
            'sub_total' => $select->price * $input,
        ]);
        return response()->json('success');
    }

    //all item 
    public function ajaxProductItemAll()
    {
        $data = DB::table('sell_product')
            ->leftjoin('products', 'products.id', '=', 'sell_product.product_id')
            ->select('products.product_name', 'sell_product.*')
            ->groupBy('id')
            ->get();
        $list = $data->map(function ($item, $key) {
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
    public function ajaxItemRemove($id)
    {
        $data = DB::table('sell_product')->where('id', $id)->delete();
        return response()->json($data);
    }

    //item vat
    public function ajaxItemVat($input)
    {
        $total_order = DB::table('sell_product')->sum('sub_total');
        $vat_amount = ($total_order / 100) * $input;
        DB::table('sale_vat_temps')->delete();
        DB::table('sale_vat_temps')->insert([
            'vat_amount' => $vat_amount
        ]);
    }

    //item discount
    public function ajaxItemDiscount($input)
    {
        $total_order = DB::table('sell_product')->sum('sub_total');
        $discount_amount = ($total_order / 100) * $input;
        DB::table('sale_discount_temps')->delete();
        DB::table('sale_discount_temps')->insert([
            'discount_amount' => $discount_amount
        ]);
    }
}
