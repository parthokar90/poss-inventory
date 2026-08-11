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
    public function getIndex()
    {
        return Product::orderBy('id', 'DESC')->with('category', 'brand')->get();
    }

    public function getCreateData()
    {
        return [
            'warehouse' => Warehouse::where('status', 1)->orderBy('id', 'DESC')->get(),
            'variants'  => Varients::where('status', 1)->orderBy('id', 'DESC')->get(),
            'brands'    => Brand::where('status', 1)->orderBy('id', 'DESC')->get(),
            'categorys' => Category::where('status', 1)->where('parent_id', 0)->orderBy('id', 'DESC')->get(),
            'units'     => Units::where('status', 1)->orderBy('id', 'DESC')->get(),
            'taxrates'  => Taxrate::where('status', 1)->orderBy('id', 'DESC')->get(),
        ];
    }

    public function storeProduct($request)
    {
        return DB::transaction(function () use ($request) {

            // 1. Handle image upload
            $imageName = $this->uploadImage($request);

            // 2. Fetch defined fillable attributes directly from Product Model
            $fillableFields = (new Product())->getFillable();

            // 3. Extract only the request data matching the Model's fillable properties
            $productData = $request->only($fillableFields);

            // 4. Append auto-generated fields to the array
            $productData['product_image'] = $imageName;
            $productData['product_slug']  = Str::slug($request->product_name);

            // 5. Create the product record safely
            $product = Product::create($productData);

            // 6. Update the unique product code using the newly created product ID
            $product->update([
                'product_code' => 'code-' . $product->id
            ]);

            // 7. Store variants if available, otherwise save single warehouse record
            if ($request->filled('varient_id') && is_array($request->varient_id)) {
                foreach ($request->varient_id as $i => $vId) {
                    ProductVarient::create([
                        'product_id'     => $product->id,
                        'warehouse_id'   => $request->variant_warehouse_id[$i] ?? $request->warehouse_id,
                        'varient_id'     => $vId,
                        'price_addition' => $request->price_addition[$i] ?? 0,
                        'qty'            => $request->variant_qty[$i] ?? 0,
                        'alert_qty'      => $request->product_alert_qty,
                        'variant_rack'   => $request->variant_rack[$i] ?? null,
                        'status'         => 1
                    ]);

                    ProductWarehouse::create([
                        'product_id'   => $product->id,
                        'warehouse_id' => $request->variant_warehouse_id[$i] ?? $request->warehouse_id,
                        'varient_id'   => $vId,
                        'qty'          => $request->variant_qty[$i] ?? 0,
                        'alert_qty'    => $request->product_alert_qty,
                        'racks'        => $request->variant_rack[$i] ?? 'No Rack'
                    ]);
                }
            } else {
                ProductWarehouse::create([
                    'product_id'   => $product->id,
                    'warehouse_id' => $request->warehouse_id ?? 1,
                    'qty'          => 100,
                    'alert_qty'    => $request->product_alert_qty,
                    'racks'        => "No Rack"
                ]);
            }

            return $product;
        });
    }

    public function getEditData($id)
    {
        $edit = Product::findOrFail($id);
        return array_merge($this->getCreateData(), [
            'edit' => $edit,
            'sub_category' => Category::find($edit->product_subcat_id),
            'item_warehouse' => ProductWarehouse::where('product_id', $id)->get(),
            'item_varient' => ProductVarient::where('product_id', $id)->get()
        ]);
    }

    public function updateProduct($request, $id)
    {
        return DB::transaction(function () use ($request, $id) {

            $imageName = $request->hasFile('product_image')
                ? $this->uploadImage($request)
                : $request->d_logo;

            $productData = $request->only([
                'product_type',
                'product_name',
                'product_cost',
                'product_price',
                'product_alert_qty',
                'product_weight',
                'product_brand',
                'product_cat_id',
                'product_subcat_id',
                'product_unit_id',
                'tax_rate_id',
                'product_details',
            ]);

            $productData['product_image'] = $imageName;

            Product::where('id', $id)->update($productData);

            ProductWarehouse::where('product_id', $id)->delete();
            ProductVarient::where('product_id', $id)->delete();

            if ($request->filled('varient_id')) {
                foreach ($request->varient_id as $i => $vId) {
                    ProductVarient::create([
                        'product_id'     => $id,
                        'warehouse_id'   => $request->warehouse_ids[$i] ?? null,
                        'varient_id'     => $vId,
                        'price_addition' => $request->price_addition[$i] ?? 0,
                        'qty'            => $request->qty[$i] ?? 0,
                        'alert_qty'      => $request->product_alert_qty,
                        'variant_rack'   => $request->racks[$i] ?? null,
                        'status'         => $request->status[$i] ?? 1,
                    ]);

                    ProductWarehouse::create([
                        'product_id'   => $id,
                        'warehouse_id' => $request->warehouse_ids[$i] ?? null,
                        'varient_id'   => $vId,
                        'qty'          => $request->qty[$i] ?? 0,
                        'alert_qty'    => $request->product_alert_qty,
                        'racks'        => $request->racks[$i] ?? null,
                    ]);
                }
            } else {
                if ($request->has('warehouse_id')) {
                    foreach ($request->warehouse_id as $i => $wId) {
                        ProductWarehouse::create([
                            'product_id'   => $id,
                            'warehouse_id' => $wId,
                            'qty'          => $request->qty[$i] ?? 0,
                            'alert_qty'    => $request->product_alert_qty,
                            'racks'        => $request->racks[$i] ?? null,
                        ]);
                    }
                }
            }
        });
    }

    private function uploadImage($request)
    {
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('product_image/'), $name);
            return $name;
        }
        return null;
    }
}
