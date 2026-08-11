@extends('admin.layouts.master')
@section('title') Dashboard | Sell Report @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    @include('admin.includes.messages')

    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Sell</h2>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="border-b border-gray-200 px-6 py-4 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Sell Report</h2>
        </div>

        <div class="p-6">
            <!-- Customer Specific Company Header -->
            <div class="text-center mb-6 space-y-1">
                <h1 class="text-2xl font-bold text-gray-800">{{ $company->company_name }}</h1>
                <p class="text-sm text-gray-600">{{ $company->company_email }}</p>
                <p class="text-sm text-gray-600">{{ $company->company_phone }}</p>
                <p class="text-sm text-gray-600">{{ $company->company_address }}</p>
                <p class="text-base font-semibold text-gray-800 mt-2">
                    Sell Report of Customer: <span class="text-indigo-600">{{ optional($data[0]->customers)->customer_name ?? 'N/A' }}</span>
                </p>
                <p class="text-sm font-semibold text-gray-700">
                    From {{ date('d-m-Y', strtotime($start)) }} To {{ date('d-m-Y', strtotime($end)) }}
                </p>
            </div>

            <!-- Customer Report Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">#</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Invoice</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Sale Date</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Vat</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Vat Amount</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Discount</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Disc. Amount</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Total Sale</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Payment</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Due</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Sale By</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Status</th>
                            <th class="px-3 py-3 text-left font-semibold text-gray-700">Items</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @php $total_sell = 0; $total_payments = 0; $total_dues = 0; @endphp
                        @foreach($data as $key => $item)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 py-3 whitespace-nowrap">{{ ++$key }}</td>
                            <td class="px-3 py-3 whitespace-nowrap font-bold text-indigo-600">Invoice-{{ $item->id }}</td>
                            <td class="px-3 py-3 whitespace-nowrap">{{ date('d-m-Y', strtotime($item->sale_date)) }}</td>
                            <td class="px-3 py-3 whitespace-nowrap">{{ $item->sale_vat }} %</td>
                            <td class="px-3 py-3 whitespace-nowrap">{{ number_format($item->sale_vat_amount) }} Tk</td>
                            <td class="px-3 py-3 whitespace-nowrap">{{ $item->sale_discount }} %</td>
                            <td class="px-3 py-3 whitespace-nowrap">{{ number_format($item->sale_discount_amount) }} Tk</td>
                            <td class="px-3 py-3 whitespace-nowrap font-medium">
                                {{ number_format($item->total_price) }} Tk 
                                @php $total_sell += $item->total_price; @endphp
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap text-green-600 font-medium">
                                {{ number_format($item->total_payment) }} Tk 
                                @php $total_payments += $item->total_payment; @endphp
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap text-red-600 font-medium">
                                {{ number_format($item->total_due) }} Tk 
                                @php $total_dues += $item->total_due; @endphp
                            </td>
                            <td class="px-3 py-3 whitespace-nowrap">{{ optional($item->user)->name }}</td>
                            <td class="px-3 py-3 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <!-- Nested Items Details Table -->
                            <td class="px-3 py-3">
                                <div class="bg-gray-50 p-2 rounded border border-gray-200">
                                    <table class="min-w-full text-xs divide-y divide-gray-200">
                                        <thead>
                                            <tr class="text-left font-semibold text-gray-600">
                                                <th class="pr-2 py-1">Warehouse</th>
                                                <th class="px-2 py-1">Product</th>
                                                <th class="px-2 py-1">Code</th>
                                                <th class="px-2 py-1">Cost</th>
                                                <th class="px-2 py-1">Price</th>
                                                <th class="pl-2 py-1">Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100">
                                            @foreach($item->saleItem as $details)
                                            <tr>
                                                <td class="pr-2 py-1">{{ $details->warehouse }}</td>
                                                <td class="px-2 py-1 font-medium">{{ $details->product }} {{ $details->varient }}</td>
                                                <td class="px-2 py-1">{{ $details->code }}</td>
                                                <td class="px-2 py-1">{{ number_format($details->cost) }} Tk</td>
                                                <td class="px-2 py-1">{{ number_format($details->product_price) }} Tk</td>
                                                <td class="pl-2 py-1 font-semibold">{{ $details->total_qty }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-100 font-bold">
                        <tr>
                            <td colspan="7" class="px-3 py-3 text-right">Total:</td>
                            <td class="px-3 py-3 whitespace-nowrap text-indigo-700">{{ number_format($total_sell) }} Tk</td>
                            <td class="px-3 py-3 whitespace-nowrap text-green-700">{{ number_format($total_payments) }} Tk</td>
                            <td class="px-3 py-3 whitespace-nowrap text-red-700">{{ number_format($total_dues) }} Tk</td>
                            <td colspan="3"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection