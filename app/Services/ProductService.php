<?php

namespace App\Services;

use App\product\Product;
use App\warehouse\Warehouse;
use App\product\ProductWarehouse;
use App\varients\Varients;
use App\varients\ProductVarient;
use App\brand\Brand;
use App\category\Category;
use App\units\Units;
use App\tax\Taxrate;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductService
{
    public function getIndex() {
        return Product::orderBy('id', 'DESC')->with('category', 'brand')->get();
    }

    public function getCreateData() {
        return [
            'warehouse' => Warehouse::where('status', 1)->orderBy('id', 'DESC')->get(),
            'variants'  => Varients::where('status', 1)->orderBy('id', 'DESC')->get(),
            'brands'    => Brand::where('status', 1)->orderBy('id', 'DESC')->get(),
            'categorys' => Category::where('status', 1)->where('parent_id', 0)->orderBy('id', 'DESC')->get(),
            'units'     => Units::where('status', 1)->orderBy('id', 'DESC')->get(),
            'taxrates'  => Taxrate::where('status', 1)->orderBy('id', 'DESC')->get(),
        ];
    }

    public function storeProduct($request) {
        return DB::transaction(function () use ($request) {
            $imageName = $this->uploadImage($request);
            $product = Product::create($request->except('product_image') + [
                'product_image' => $imageName,
                'product_slug' => Str::slug($request->product_name)
            ]);
            
            $product->update(['product_code' => 'code-' . $product->id]);

            if ($request->filled('varient_id')) {
                foreach ($request->varient_id as $i => $vId) {
                    ProductVarient::create(['product_id' => $product->id, 'warehouse_id' => $request->variant_warehouse_id[$i], 'varient_id' => $vId, 'price_addition' => $request->price_addition[$i], 'qty' => $request->variant_qty[$i] ?? 0, 'alert_qty' => $request->product_alert_qty, 'variant_rack' => $request->variant_rack[$i], 'status' => 1]);
                    ProductWarehouse::create(['product_id' => $product->id, 'warehouse_id' => $request->variant_warehouse_id[$i], 'varient_id' => $vId, 'qty' => $request->variant_qty[$i] ?? 0, 'alert_qty' => $request->product_alert_qty, 'racks' => $request->variant_rack[$i]]);
                }
            } else {
                ProductWarehouse::create(['product_id' => $product->id, 'warehouse_id' => $request->warehouse_id, 'qty' => 100, 'alert_qty' => $request->product_alert_qty, 'racks' => "No Rack"]);
            }
        });
    }

    public function getEditData($id) {
        $edit = Product::findOrFail($id);
        return array_merge($this->getCreateData(), [
            'edit' => $edit,
            'sub_category' => Category::find($edit->product_subcat_id),
            'item_warehouse' => ProductWarehouse::where('product_id', $id)->get(),
            'item_varient' => ProductVarient::where('product_id', $id)->get()
        ]);
    }

    public function updateProduct($request, $id) {
        return DB::transaction(function () use ($request, $id) {
            $imageName = $request->hasFile('product_image') ? $this->uploadImage($request) : $request->d_logo;
            Product::where('id', $id)->update($request->except(['_token', 'product_image', 'd_logo', 'varient_id', 'warehouse_ids', 'qty', 'racks']) + ['product_image' => $imageName]);

            ProductWarehouse::where('product_id', $id)->delete();
            ProductVarient::where('product_id', $id)->delete();

            if ($request->filled('varient_id')) {
                foreach ($request->varient_id as $i => $vId) {
                    ProductVarient::create(['product_id' => $id, 'warehouse_id' => $request->warehouse_ids[$i], 'varient_id' => $vId, 'price_addition' => $request->price_addition[$i], 'qty' => $request->qty[$i], 'alert_qty' => $request->product_alert_qty, 'variant_rack' => $request->racks[$i], 'status' => $request->status[$i]]);
                    ProductWarehouse::create(['product_id' => $id, 'warehouse_id' => $request->warehouse_ids[$i], 'varient_id' => $vId, 'qty' => $request->qty[$i], 'alert_qty' => $request->product_alert_qty, 'racks' => $request->racks[$i]]);
                }
            } else {
                foreach ($request->warehouse_id as $i => $wId) {
                    ProductWarehouse::create(['product_id' => $id, 'warehouse_id' => $wId, 'qty' => $request->qty[$i], 'alert_qty' => $request->product_alert_qty, 'racks' => $request->racks[$i]]);
                }
            }
        });
    }

    private function uploadImage($request) {
        $name = time() . '.' . $request->product_image->getClientOriginalExtension();
        $request->product_image->move(public_path('product_image/'), $name);
        return $name;
    }
}