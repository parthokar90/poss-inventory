<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MasterDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_US');

        $warehouseIds = range(1, 10);

        // -----------------------------------------------------------------
        // 1. COMPANIES (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            DB::table('companies')->insert([
                'company_name' => $faker->company . ' ' . $i,
                'company_email' => 'info' . $i . '@' . $faker->freeEmailDomain,
                'company_phone' => $faker->phoneNumber,
                'company_logo' => 'logos/company_' . $i . '.png',
                'company_address' => $faker->buildingNumber . ' ' . $faker->streetName,
                'country' => 'Bangladesh',
                'company_city' => $faker->city,
                'company_state' => $faker->state,
                'company_postcode' => $faker->postcode,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // -----------------------------------------------------------------
        // 2. CUSTOMERS (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            DB::table('customers')->insert([
                'customer_name' => $faker->name,
                'customer_phone' => $faker->phoneNumber,
                'customer_email' => 'customer' . $i . '@' . $faker->freeEmailDomain,
                'customer_address' => $faker->address,
                'country' => 'Bangladesh',
                'state' => $faker->state,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // -----------------------------------------------------------------
        // 3. SUPPLIERS (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            DB::table('suppliers')->insert([
                'supplier_name' => $faker->company . ' Ltd. ' . $i,
                'supplier_phone' => $faker->phoneNumber,
                'supplier_email' => 'supplier' . $i . '@' . $faker->freeEmailDomain,
                'supplier_address' => $faker->address,
                'country' => 'Bangladesh',
                'state' => $faker->state,
                'city' => $faker->city,
                'postcode' => $faker->postcode,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // -----------------------------------------------------------------
        // 4. BRANDS (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            $bName = $faker->word . ' Brand ' . $i;
            DB::table('brands')->insert([
                'name' => ucfirst($bName),
                'image' => 'brands/' . Str::slug($bName) . '.png',
                'slug' => Str::slug($bName),
                'description' => $faker->sentence,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // -----------------------------------------------------------------
        // 5. UNITS (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            $uName = $faker->word . ' Unit-' . $i;
            DB::table('units')->insert([
                'unit_name' => ucfirst($uName),
                'unit_value' => Str::slug($uName),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // -----------------------------------------------------------------
        // 6. VARIENTS (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            $vName = $faker->word . ' ' . $faker->randomElement(['Size', 'Color', 'Type']) . '-' . $i;
            DB::table('varients')->insert([
                'varient_name' => $vName,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // -----------------------------------------------------------------
        // 7. CATEGORIES (150 Data - 50 Parent, 100 Child)
        // -----------------------------------------------------------------
        $parentCategoryIds = [];
        for ($i = 1; $i <= 50; $i++) {
            $cName = $faker->word . ' Cat-' . $i;
            $parentCategoryIds[] = DB::table('categories')->insertGetId([
                'category_name' => ucfirst($cName),
                'parent_id' => 0,
                'slug' => Str::slug($cName),
                'image' => 'categories/' . Str::slug($cName) . '.png',
                'description' => $faker->text(50),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        for ($i = 1; $i <= 100; $i++) {
            $cName = $faker->word . ' SubCat-' . $i;
            DB::table('categories')->insert([
                'category_name' => ucfirst($cName),
                'parent_id' => $faker->randomElement($parentCategoryIds),
                'slug' => Str::slug($cName),
                'image' => 'categories/' . Str::slug($cName) . '.png',
                'description' => $faker->text(50),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // -----------------------------------------------------------------
        // 8. TAXRATES (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            DB::table('taxrates')->insert([
                'name' => 'Tax ' . $faker->word . '-' . $i,
                'type' => $faker->randomElement(['percentage', 'fixed']),
                'rate' => (string)$faker->numberBetween(0, 25),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $brandIds = DB::table('brands')->pluck('id')->toArray();
        $unitIds = DB::table('units')->pluck('id')->toArray();
        $taxIds = DB::table('taxrates')->pluck('id')->toArray();
        $allCategoryIds = DB::table('categories')->pluck('id')->toArray();

        // -----------------------------------------------------------------
        // 9. PRODUCTS (150 Data)
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            $pName = $faker->sentence(2) . ' ' . $i;
            $cost = $faker->numberBetween(50, 5000);
            $price = $cost + $faker->numberBetween(20, 1000);

            $catId = $faker->randomElement($parentCategoryIds);
            $subCatId = DB::table('categories')->where('parent_id', $catId)->pluck('id')->first() ?? $faker->randomElement($allCategoryIds);

            DB::table('products')->insert([
                'product_type' => $faker->randomElement(['standard', 'digital', 'service']),
                'product_name' => $pName,
                'product_code' => 'CODE-' . (100000 + $i),
                'product_slug' => Str::slug($pName),
                'product_cost' => (string)$cost,
                'product_price' => $price,
                'product_alert_qty' => (string)$faker->numberBetween(5, 20),
                'product_weight' => $faker->randomElement(['0.5kg', '1kg', '5kg', 'N/A']),
                'product_image' => 'products/prod_' . $i . '.png',
                'product_qty' => (string)$faker->numberBetween(50, 500),
                'tax_rate_id' => $faker->randomElement($taxIds),
                'product_brand' => $faker->randomElement($brandIds),
                'product_cat_id' => $catId,
                'product_subcat_id' => $subCatId,
                'product_unit_id' => $faker->randomElement($unitIds),
                'product_details' => $faker->paragraph,
                'product_details_invoice' => $faker->sentence,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $productIds = DB::table('products')->pluck('id')->toArray();
        $variantIds = DB::table('varients')->pluck('id')->toArray();

        // -----------------------------------------------------------------
        // 10. PRODUCT_WAREHOUSES & 11. PRODUCT_VARIENTS (150 Data Each)
        // -----------------------------------------------------------------
        for ($i = 1; $i < 150; $i++) {
            $pId = $productIds[$i];
            $wId = $faker->randomElement($warehouseIds);
            $vId = $variantIds[$i];

            DB::table('product_warehouses')->insert([
                'product_id' => $pId,
                'warehouse_id' => $wId,
                'varient_id' => $vId,
                'qty' => $faker->numberBetween(10, 200),
                'alert_qty' => $faker->numberBetween(2, 10),
                'racks' => 'Rack-' . $faker->bothify('?##'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('product_varients')->insert([
                'product_id' => $pId,
                'varient_id' => $vId,
                'warehouse_id' => $wId,
                'price_addition' => (string)$faker->numberBetween(50, 500),
                'qty' => (string)$faker->numberBetween(5, 100),
                'alert_qty' => 5,
                'variant_rack' => 'VRack-' . $faker->bothify('#?#'),
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $supplierIds = DB::table('suppliers')->pluck('id')->toArray();

        // -----------------------------------------------------------------
        // 12. PURCHASES (150 Data) & 13. PURCHASE_ITEMS (150 Data) - DYNAMIC DATE
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            $supId = $faker->randomElement($supplierIds);
            $orderTotal = $faker->numberBetween(5000, 50000);
            $vatAmt = $orderTotal * 0.10;
            $discount = $faker->randomElement([0, 100, 200, 500]);
            $totalPrice = ($orderTotal + $vatAmt) - $discount;
            $paid = $faker->randomElement([$totalPrice, $totalPrice - 1500, 0]);
            $due = $totalPrice - $paid;

            $purchaseDate = Carbon::today()->addDays($i-1)->format('Y-m-d');

            $purchaseId = DB::table('purchases')->insertGetId([
                'supplier_id' => $supId,
                'purchase_date' => $purchaseDate,
                'purchase_vat' => '10%',
                'purchase_vat_amount' => (string)$vatAmt,
                'purchase_discount' => 'Fixed',
                'purchase_discount_amount' => (string)$discount,
                'purchase_note' => $faker->sentence,
                'purchased_by' => $faker->numberBetween(1, 5),
                'order_total_price' => (string)$orderTotal,
                'total_price' => (string)$totalPrice,
                'total_payment' => (string)$paid,
                'total_due' => (string)$due,
                'status' => $faker->randomElement(['Received', 'Ordered', 'Pending']),
                'payment_status' => $due == 0 ? 'Paid' : ($paid > 0 ? 'Partial' : 'Due'),
                'created_at' => Carbon::parse($purchaseDate)->setTime(rand(9, 18), rand(0, 59)),
                'updated_at' => Carbon::parse($purchaseDate)->setTime(rand(9, 18), rand(0, 59)),
            ]);

            $randomProd = DB::table('products')->where('id', $productIds[$i - 1])->first();
            $qty = $faker->numberBetween(5, 50);
            $subTotal = (int)$randomProd->product_cost * $qty;

            DB::table('purchase_items')->insert([
                'purchase_id' => $purchaseId,
                'supplier_id' => $supId,
                'purchase_date' => $purchaseDate,
                'purchased_by' => $faker->numberBetween(1, 5),
                'warehouse_id' => $faker->randomElement($warehouseIds),
                'warehouse' => 'Warehouse ' . $faker->randomElement($warehouseIds),
                'product_id' => $randomProd->id,
                'product' => $randomProd->product_name,
                'product_price' => $randomProd->product_price,
                'code' => $randomProd->product_code,
                'cost' => $randomProd->product_cost,
                'tax' => '10',
                'tax_rate_id' => (string)$randomProd->tax_rate_id,
                'tax_rate_type' => 'percentage',
                'varient_id' => (string)$variantIds[$i - 1],
                'varient' => 'Variant-' . $variantIds[$i - 1],
                'varient_price' => '100',
                'total_qty' => (string)$qty,
                'sub_total' => (string)$subTotal,
                'created_at' => Carbon::parse($purchaseDate)->setTime(rand(9, 18), rand(0, 59)),
                'updated_at' => Carbon::parse($purchaseDate)->setTime(rand(9, 18), rand(0, 59)),
            ]);
        }

        $customerIds = DB::table('customers')->pluck('id')->toArray();

        // -----------------------------------------------------------------
        // 14. SALES (150 Data) & 15. SALE_ITEMS (150 Data) - DYNAMIC DATE
        // -----------------------------------------------------------------
        for ($i = 1; $i <= 150; $i++) {
            $custId = $faker->randomElement($customerIds);
            $saleTotal = $faker->numberBetween(2000, 40000);
            $vatAmt = $saleTotal * 0.05;
            $discount = $faker->randomElement([0, 50, 150, 300]);
            $grandTotal = ($saleTotal + $vatAmt) - $discount;
            $paid = $faker->randomElement([$grandTotal, $grandTotal - 1000, 0]);
            $due = $grandTotal - $paid;

            $saleDate = Carbon::today()->addDays($i-1)->format('Y-m-d');

            $saleId = DB::table('sales')->insertGetId([
                'customer_id' => $custId,
                'biller_id' => $faker->numberBetween(1, 3),
                'sale_date' => $saleDate,
                'sale_vat' => '5%',
                'sale_vat_amount' => (string)$vatAmt,
                'sale_discount' => 'Fixed',
                'sale_discount_amount' => (string)$discount,
                'sale_note' => $faker->sentence,
                'sale_by' => $faker->numberBetween(1, 5),
                'sale_total_price' => (string)$saleTotal,
                'total_price' => (string)$grandTotal,
                'total_payment' => (string)$paid,
                'total_due' => (string)$due,
                'payment_method' => $faker->randomElement(['Cash', 'Bkash', 'Bank']),
                'status' => $due == 0 ? 'Completed' : 'Pending',
                'created_at' => Carbon::parse($saleDate)->setTime(rand(9, 21), rand(0, 59)),
                'updated_at' => Carbon::parse($saleDate)->setTime(rand(9, 21), rand(0, 59)),
            ]);

            $randomProd = DB::table('products')->where('id', $productIds[$i - 1])->first();
            $qty = $faker->numberBetween(1, 10);
            $subTotal = (int)$randomProd->product_price * $qty;

            DB::table('sale_items')->insert([
                'sales_id' => $saleId,
                'customer_id' => $custId,
                'biller_id' => $faker->numberBetween(1, 3),
                'sales_date' => $saleDate,
                'sales_by' => $faker->numberBetween(1, 5),
                'warehouse_id' => $faker->randomElement($warehouseIds),
                'warehouse' => 'Warehouse ' . $faker->randomElement($warehouseIds),
                'product_id' => $randomProd->id,
                'product' => $randomProd->product_name,
                'product_price' => $randomProd->product_price,
                'code' => $randomProd->product_code,
                'cost' => $randomProd->product_cost,
                'tax' => '5',
                'tax_rate_id' => (string)$randomProd->tax_rate_id,
                'tax_rate_type' => 'percentage',
                'varient_id' => (string)$variantIds[$i - 1],
                'varient' => 'Variant-' . $variantIds[$i - 1],
                'varient_price' => '100',
                'total_qty' => (string)$qty,
                'sub_total' => (string)$subTotal,
                'created_at' => Carbon::parse($saleDate)->setTime(rand(9, 21), rand(0, 59)),
                'updated_at' => Carbon::parse($saleDate)->setTime(rand(9, 21), rand(0, 59)),
            ]);
        }

        // -----------------------------------------------------------------
        // 16. SUPPLIER_PAYMENTS (150 Data)
        // -----------------------------------------------------------------
        $purchases = DB::table('purchases')->get();
        foreach ($purchases as $purchase) {
            $paymentMethod = $faker->randomElement(['Cash', 'Bkash', 'Bank']);
            $payAmount = (float)$purchase->total_payment > 0 ? (float)$purchase->total_payment : (float)$purchase->total_price;

            DB::table('supplier_payments')->insert([
                'purchase_invoice_id' => $purchase->id,
                'supplier_id' => $purchase->supplier_id,
                'payment_date' => $purchase->purchase_date,
                'total_purchase' => (float)$purchase->total_price,
                'total_payment' => $payAmount,
                'total_due' => (float)$purchase->total_price - $payAmount,
                'payment_amount' => $payAmount,
                'payment_by' => $purchase->purchased_by,
                'bkash_trx_id' => $paymentMethod == 'Bkash' ? 'TRX' . Str::upper($faker->bothify('??##?#?#')) : null,
                'bkash_acc_no' => $paymentMethod == 'Bkash' ? $faker->numerify('017########') : null,
                'bkash_payment_amount' => $paymentMethod == 'Bkash' ? (string)$payAmount : null,
                'bank_acc_no' => $paymentMethod == 'Bank' ? $faker->bankAccountNumber : null,
                'bank_payment_amount' => $paymentMethod == 'Bank' ? (string)$payAmount : null,
                'payment_method' => $paymentMethod,
                'payment_status' => ((float)$purchase->total_price - $payAmount) == 0 ? 'Success' : 'Partial',
                'created_at' => $purchase->created_at,
                'updated_at' => $purchase->updated_at,
            ]);
        }
    }
}
