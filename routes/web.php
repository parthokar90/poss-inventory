<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


  Auth::routes();

//---------------------------------- Cash clear route start --------------------------------\\  
    Route::get('/cc', function() {
         Artisan::call('cache:clear');
         Artisan::call('route:clear');
         Artisan::call('view:clear');
         Artisan::call('config:cache');
         return '<h1>Clear Cache</h1>';
    });
//---------------------------------- Cash clear route end ---------------------------------\\  


//---------------------------------- Auth route start -------------------------------------\\  
    Route::get('/logout','Auth\LoginController@logout');
//---------------------------------- Auth route end ---------------------------------------\\  

//---------------------------------- Dashboard route start --------------------------------\\  
    Route::group(['namespace'=>'Admin'],function(){
       Route::get('/','DashboardController@Dashboard')->name('dashboard');
    });   
//---------------------------------- Dashboard route end ----------------------------------\\  


//---------------------------------- Settings route start ---------------------------------\\  
    Route::group(['namespace'=>'company'],function(){
       Route::resource('office','CompanyController');
    });   
    Route::group(['namespace'=>'supplier'],function(){
       Route::resource('supplier','SupplierController');
       Route::resource('payment-supplier','SupplierPaymentController');
       Route::post('payment-supplier-update','SupplierPaymentController@payment')->name('payment_supplier_update');
    });   
    Route::group(['namespace'=>'customer'],function(){
       Route::resource('customer','CustomerController');
    });   
    Route::group(['namespace'=>'brand'],function(){
       Route::resource('brand','BrandController');
    });   
    Route::group(['namespace'=>'unit'],function(){
       Route::resource('units','UnitController');
    });   
    Route::group(['namespace'=>'attribute'],function(){
       Route::resource('attribute','AttributeController');
    });    
    Route::group(['namespace'=>'taxrate'],function(){
       Route::resource('taxrate','TaxrateController');
    });
    Route::group(['namespace'=>'biller'],function(){
       Route::resource('billers','BillerController');
    });
    Route::group(['namespace'=>'warehouse'],function(){
       Route::resource('warehouse','WareHouseController');
    });
    Route::group(['namespace'=>'category'],function(){
       Route::resource('category','CategoryController');
       Route::get('sub-category/{cat_id}','CategoryController@subCategory');
    });
    Route::group(['namespace'=>'expense'],function(){
       Route::resource('expense','ExpenseCategoryController');
    });
 //----------------------------------Settings route end------------------------------------\\

 //---------------------------------- Product route start ---------------------------------\\  
   Route::group(['namespace'=>'product'],function(){
       Route::resource('product','ProductController');
       Route::get('stock-list','StockController@stockList')->name('stockList');
       Route::get('search_product','ProductController@searchProduct')->name('item_product_search');
       Route::get('search_stock_product','StockController@stockSearchProduct')->name('item_stock_search');
       Route::get('alert/notification','StockController@stockAlertNotification')->name('item_stock_alert_notification');
       Route::get('product/ajax/{id}','ProductController@ajaxProduct');
       Route::get('/ajax/item/all','ProductController@ajaxProductItemAll');
       Route::get('/ajax/item','ProductController@ajaxProductItem');
       Route::get('/ajax/total','ProductController@ajaxProductTotal');
       Route::get('/ajax/item/remove/{id}','ProductController@ajaxItemRemove');
       Route::get('/ajax/item/update/{id}/{input}','ProductController@ajaxItemUpdate');
       Route::get('/ajax/tax/{input}','ProductController@ajaxItemVat');
       Route::get('/ajax/discount/{input}','ProductController@ajaxItemDiscount');
       Route::get('/ajax/grandTotal/','ProductController@ajaxProductTotalVatDiscount');
   });
//---------------------------------- Product route start ---------------------------------\\ 

//----------------------------------Quotation route start ---------------------------------\\
   Route::group(['namespace'=>'quotation'],function(){
       Route::resource('quotations','QuotationController');
   });   
//----------------------------------Quotation route end ------------------------------------\\


//---------------------------------- Expense route start ---------------------------------\\  
   Route::group(['namespace'=>'expense'],function(){
       Route::resource('expense_amount','ExpenseAmountController');
   });
//---------------------------------- Expense route start ---------------------------------\\  

//---------------------------------- Purchase route start ---------------------------------\\  
   Route::group(['namespace'=>'purchase'],function(){
       Route::resource('purchase','PurchaseController');
       Route::post('temp/purchase','PurchaseController@purchaseTemp');
       Route::get('temp/purchase/product/delete/{id}','PurchaseController@purchaseProductDelete')->name('full_delete');
       Route::get('temp/purchase/item/delete/{id}','PurchaseController@purchaseItemDelete')->name('item_delete');
       Route::post('/discount_purchase','PurchaseController@discount')->name('discount_purchase');
       Route::post('/vat_purchase','PurchaseController@vat')->name('vat_purchase');
   });
//---------------------------------- Purchase route start ---------------------------------\\  

//---------------------------------- sell route start ---------------------------------\\  
   Route::group(['namespace'=>'sell'],function(){
       Route::resource('sales','SellController');
       Route::get('/warehouse_product/{id}','SellController@warehouse_product');
       Route::post('/vat_discount','SellController@vat_discount')->name('vat_discount_temp');
       Route::post('/sale_items','SellController@saleFinal')->name('sale_final');
       Route::post('/sale_items/update/{id}','SellController@qtyUpdate')->name('sale_update');
   });
//---------------------------------- sell route start ---------------------------------\\  

//---------------------------------- report route start ---------------------------------\\  
   Route::group(['namespace'=>'report'],function(){
       Route::get('expense_report','ExpenseReportController@expenseReport')->name('expense_reports');
       Route::post('expense_report','ExpenseReportController@expenseReportShow')->name('expense_reports_show');
       Route::post('expense_report_date','ExpenseReportController@expenseReportDate')->name('expense_reports_date');
       Route::get('purchase_report','PurchaseReportController@purchaseReport')->name('purchase_reports');
       Route::post('purchase_report_supplier','PurchaseReportController@purchaseReportShowSupplier')->name('purchase_reports_show_supplier');
       Route::post('purchase_report_date_wise','PurchaseReportController@purchaseReportShowAll')->name('purchase_reports_show_all');
       Route::get('supplier_report','SupplierReportController@index')->name('supplier_reports');
       Route::post('supplier_report_generate','SupplierReportController@supplierReport')->name('supplier_reports_generate');
       Route::post('supplier_report_generate_payment','SupplierReportController@supplierReport')->name('supplier_reports_generate_payment');
       Route::get('sale_report','SellReportController@saleReport')->name('sale_reports');
       Route::post('sale_report_customer','SellReportController@saleReportShowCustomer')->name('sale_reports_show_customer');
       Route::post('sale_report_date_wise','SellReportController@saleReportShowAll')->name('sale_reports_show_all');
       Route::get('/gross/profit','GrossProfitController@index')->name('gross.profit');
       Route::post('/gross/profit/report','GrossProfitController@profitReport')->name('gross.profit_report');
   });
//---------------------------------- report route start ---------------------------------\\  




