<?php

namespace App\Services;

use App\product\Product;
use App\supplier\Supplier;
use App\customer\Customer;
use App\User;
use App\purchase\Purchase;
use App\sale\Sale;
use App\expense\ExpenseAmount;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class DashboardService
{
    /**
     * Get all essential statistics and logs for the dashboard.
     *
     * @return array
     * @throws Exception
     */
    public function getDashboardData(): array
    {
        try {
            // Get current system date using Carbon for accuracy
            $today = Carbon::today()->toDateString();

            // Fetch overall summary counts using Eloquent Models
            $totalProduct = Product::count();
            $totalUsers = User::count();
            $totalSupplier = Supplier::count();
            $totalCustomer = Customer::count();

            // Calculate financial metrics for the current day
            $todayPurchase = Purchase::where('purchase_date', $today)->sum('total_price');
            $todaySales = Sale::where('sale_date', $today)->sum('total_price');
            $todayExpense = ExpenseAmount::where('expense_date', $today)->sum('expense_amount');

            // Retrieve today's activity logs with proper relationship eager loading
            $purchaseList = Purchase::where('purchase_date', $today)
                ->orderBy('id', 'DESC')
                ->with(['user', 'suppliers'])
                ->get();

            $salesList = Sale::where('sale_date', $today)
                ->orderBy('id', 'DESC')
                ->with(['user', 'customers'])
                ->get();

            // Return bundled stats to the controller
            return [
                'total_product'  => $totalProduct,
                'total_users'    => $totalUsers,
                'total_supplier' => $totalSupplier,
                'total_customer' => $totalCustomer,
                'today_purchase' => $todayPurchase,
                'today_sales'    => $todaySales,
                'today_expense'  => $todayExpense,
                'purchase_list'  => $purchaseList,
                'sales_list'     => $salesList,
            ];

        } catch (Exception $e) {
            // Log the exception message for internal debugging
            Log::error('Error fetching dashboard statistics: ' . $e->getMessage());
            
            // Rethrow exception to be caught handled by the controller
            throw new Exception('Unable to load dashboard data at this moment.');
        }
    }
}