@extends('admin.layouts.master')

@section('title', 'Dashboard | Purchase Report')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Flash Messages -->
    @include('admin.includes.messages')

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Purchase</h2>
    </div>

    <!-- Main Card Content -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <!-- Card Header -->
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Purchase Report</h2>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            
            <!-- Company Info & Report Header -->
            <div class="text-center pb-6 mb-6 border-b border-gray-200 space-y-1">
                <h1 class="text-2xl font-bold text-gray-900 tracking-tight">{{ $company->company_name }}</h1>
                <p class="text-sm text-gray-600">{{ $company->company_email }}</p>
                <p class="text-sm text-gray-600">{{ $company->company_phone }}</p>
                <p class="text-sm text-gray-600">{{ $company->company_address }}</p>
                <div class="pt-2">
                    <span class="inline-block text-base font-semibold text-gray-800 uppercase tracking-wider">Purchase Report</span>
                </div>
                <div class="pt-1">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                        From {{ date('d-m-Y', strtotime($start)) }} To {{ date('d-m-Y', strtotime($end)) }}
                    </span>
                </div>
            </div>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-100 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider whitespace-nowrap">
                            <th class="py-3 px-4">#</th>
                            <th class="py-3 px-4">Invoice</th>
                            <th class="py-3 px-4">Purchase Date</th>
                            <th class="py-3 px-4">Vat (%)</th>
                            <th class="py-3 px-4">Vat Amt</th>
                            <th class="py-3 px-4">Discount (%)</th>
                            <th class="py-3 px-4">Discount Amt</th>
                            <th class="py-3 px-4">Purchase Total</th>
                            <th class="py-3 px-4">Payment</th>
                            <th class="py-3 px-4">Due</th>
                            <th class="py-3 px-4">Supplier</th>
                            <th class="py-3 px-4">Purchased By</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 min-w-[400px]">Items Breakdown</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-xs text-gray-700">
                        @php 
                            $total_purchase = 0; 
                            $total_payments = 0; 
                            $total_dues = 0; 
                        @endphp

                        @foreach($data as $key => $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150 align-top">
                            <!-- Index -->
                            <td class="py-3 px-4 font-medium text-gray-900">{{ ++$key }}</td>
                            
                            <!-- Invoice Number -->
                            <td class="py-3 px-4 font-bold text-indigo-600 whitespace-nowrap">Invoice-{{ $item->id }}</td>
                            
                            <!-- Purchase Date -->
                            <td class="py-3 px-4 whitespace-nowrap">{{ date('d-m-Y', strtotime($item->purchase_date)) }}</td>
                            
                            <!-- Vat Percent & Amount -->
                            <td class="py-3 px-4 whitespace-nowrap">{{ $item->purchase_vat }}%</td>
                            <td class="py-3 px-4 whitespace-nowrap">{{ number_format($item->purchase_vat_amount) }} Tk</td>
                            
                            <!-- Discount Percent & Amount -->
                            <td class="py-3 px-4 whitespace-nowrap">{{ $item->purchase_discount }}%</td>
                            <td class="py-3 px-4 whitespace-nowrap">{{ number_format($item->purchase_discount_amount) }} Tk</td>
                            
                            <!-- Total Purchase Price -->
                            <td class="py-3 px-4 font-semibold text-gray-900 whitespace-nowrap">
                                {{ number_format($item->total_price) }} Tk
                                @php $total_purchase += $item->total_price; @endphp
                            </td>
                            
                            <!-- Payment -->
                            <td class="py-3 px-4 font-semibold text-emerald-600 whitespace-nowrap">
                                {{ number_format($item->total_payment) }} Tk
                                @php $total_payments += $item->total_payment; @endphp
                            </td>
                            
                            <!-- Due -->
                            <td class="py-3 px-4 font-semibold text-red-600 whitespace-nowrap">
                                {{ number_format($item->total_due) }} Tk
                                @php $total_dues += $item->total_due; @endphp
                            </td>
                            
                            <!-- Supplier & User -->
                            <td class="py-3 px-4 font-medium whitespace-nowrap">{{ optional($item->suppliers)->supplier_name }}</td>
                            <td class="py-3 px-4 whitespace-nowrap">{{ optional($item->user)->name }}</td>
                            
                            <!-- Status -->
                            <td class="py-3 px-4 whitespace-nowrap">
                                @if(strtolower($item->status) == 'paid' || $item->status == '1' || strtolower($item->status) == 'completed')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-emerald-100 text-emerald-800">
                                        {{ $item->status }}
                                    </span>
                                @elseif(strtolower($item->status) == 'partial' || strtolower($item->status) == 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-amber-100 text-amber-800">
                                        {{ $item->status }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">
                                        {{ $item->status }}
                                    </span>
                                @endif
                            </td>
                            
                            <!-- Items Breakdown Nested Table -->
                            <td class="py-2 px-3">
                                <div class="overflow-x-auto rounded border border-gray-200 shadow-sm bg-white">
                                    <table class="w-full text-left text-xs">
                                        <thead>
                                            <tr class="bg-gray-50 border-b border-gray-200 text-gray-600 font-semibold">
                                                <th class="p-1.5">Warehouse</th>
                                                <th class="p-1.5">Product</th>
                                                <th class="p-1.5">Code</th>
                                                <th class="p-1.5">Cost</th>
                                                <th class="p-1.5">Price</th>
                                                <th class="p-1.5 text-center">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($item->purchaseItem as $details)
                                            <tr class="hover:bg-gray-50">
                                                <td class="p-1.5 whitespace-nowrap text-gray-600">{{ $details->warehouse }}</td>
                                                <td class="p-1.5 whitespace-nowrap font-medium text-gray-800">{{ $details->product }} {{ $details->varient }}</td>
                                                <td class="p-1.5 whitespace-nowrap text-gray-500">{{ $details->code }}</td>
                                                <td class="p-1.5 whitespace-nowrap">{{ number_format($details->cost) }} Tk</td>
                                                <td class="p-1.5 whitespace-nowrap">{{ number_format($details->product_price) }} Tk</td>
                                                <td class="p-1.5 whitespace-nowrap text-center font-semibold text-gray-700">{{ $details->total_qty }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                    <!-- Table Summary Footer -->
                    <tfoot>
                        <tr class="bg-gray-100 border-t-2 border-gray-300 font-bold text-xs text-gray-800 uppercase">
                            <td colspan="7" class="py-3 px-4 text-right">Overall Total:</td>
                            <td class="py-3 px-4 text-indigo-700 whitespace-nowrap">{{ number_format($total_purchase) }} Tk</td>
                            <td class="py-3 px-4 text-emerald-700 whitespace-nowrap">{{ number_format($total_payments) }} Tk</td>
                            <td class="py-3 px-4 text-red-700 whitespace-nowrap">{{ number_format($total_dues) }} Tk</td>
                            <td colspan="4"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection