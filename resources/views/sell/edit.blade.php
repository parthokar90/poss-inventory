@extends('admin.layouts.master')

@section('title') Dashboard | Sell Info @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    
    <!-- Flash Messages Include -->
    @include('admin.includes.messages')

    <!-- Main Card Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        
        <!-- Page Header Banner -->
        <div class="bg-slate-900 text-white px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 border-b border-slate-800">
            <div class="flex items-center gap-3">
                <div class="p-2 bg-indigo-500/10 rounded-lg border border-indigo-500/20">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold tracking-wide uppercase">
                    Sell Information &mdash; <span class="text-indigo-400">Invoice #{{ $invoice_details?->id ?? 'N/A' }}</span>
                </h1>
            </div>
        </div>

        <div class="p-6 space-y-8">
            
            <!-- 4-Column Invoice Information Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- 1. Customer Details -->
                <div class="bg-slate-50/70 rounded-xl p-5 border border-slate-200/80 shadow-sm space-y-3">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="p-2 bg-indigo-100 text-indigo-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-800">Customer Details</h3>
                    </div>
                    <div class="text-sm text-slate-600 space-y-1">
                        <p class="font-medium text-slate-900">{{ $invoice_details->customers?->customer_name ?? 'N/A' }}</p>
                        <p>{{ $invoice_details->customers?->customer_phone ?? 'N/A' }}</p>
                        <p class="break-all text-slate-500">{{ $invoice_details->customers?->customer_email ?? '' }}</p>
                        <p>{{ $invoice_details->customers?->customer_address ?? '' }}</p>
                        @if($invoice_details->customers?->city || $invoice_details->customers?->country)
                            <p class="text-xs text-slate-500">
                                {{ implode(', ', array_filter([$invoice_details->customers?->city, $invoice_details->customers?->country])) }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- 2. Biller Details -->
                <div class="bg-slate-50/70 rounded-xl p-5 border border-slate-200/80 shadow-sm space-y-3">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="p-2 bg-blue-100 text-blue-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0h4m-4 0H9m4 0V7m0 0h4m-4 0H9" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-800">Biller Details</h3>
                    </div>
                    <div class="text-sm text-slate-600 space-y-1">
                        <p class="font-medium text-slate-900">{{ $invoice_details->billers?->company ?? 'N/A' }}</p>
                        <p>{{ $invoice_details->billers?->phone ?? 'N/A' }}</p>
                        <p class="break-all text-slate-500">{{ $invoice_details->billers?->email ?? '' }}</p>
                        <p>{{ $invoice_details->billers?->customer_address ?? '' }}</p>
                        @if($invoice_details->billers?->vat_no)
                            <p class="text-xs font-semibold text-slate-500">VAT: {{ $invoice_details->billers?->vat_no }}</p>
                        @endif
                        @if($invoice_details->billers?->city || $invoice_details->billers?->state || $invoice_details->billers?->country)
                            <p class="text-xs text-slate-500">
                                {{ implode(', ', array_filter([$invoice_details->billers?->city, $invoice_details->billers?->state, $invoice_details->billers?->country])) }}
                            </p>
                        @endif
                    </div>
                </div>

                <!-- 3. Payment Details -->
                <div class="bg-slate-50/70 rounded-xl p-5 border border-slate-200/80 shadow-sm space-y-3">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="p-2 bg-emerald-100 text-emerald-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-800">Payment Details</h3>
                    </div>
                    <div class="text-sm text-slate-600 space-y-1.5">
                        <p class="flex justify-between"><span>Sub Total:</span> <span class="font-medium text-slate-900">{{ number_format($sub_total ?? 0) }} Tk</span></p>
                        <p class="flex justify-between"><span>Vat (%):</span> <span class="font-medium text-slate-900">{{ number_format($invoice_details?->sale_vat ?? 0) }}%</span></p>
                        <p class="flex justify-between"><span>(+) Vat Amount:</span> <span class="font-medium text-slate-900">{{ number_format($invoice_details?->sale_vat_amount ?? 0) }} Tk</span></p>
                        <p class="flex justify-between"><span>Discount (%):</span> <span class="font-medium text-slate-900">{{ number_format($invoice_details?->sale_discount ?? 0) }}%</span></p>
                        <p class="flex justify-between"><span>(-) Discount Amount:</span> <span class="font-medium text-slate-900">{{ number_format($invoice_details?->sale_discount_amount ?? 0) }} Tk</span></p>
                        
                        @php 
                            $grand_sub = (($sub_total ?? 0) + ($invoice_details?->sale_vat_amount ?? 0)) - ($invoice_details?->sale_discount_amount ?? 0); 
                        @endphp
                        
                        <div class="pt-2 border-t border-slate-200 space-y-1">
                            <p class="flex justify-between font-semibold text-slate-900"><span>Total:</span> <span>{{ number_format($grand_sub) }} Tk</span></p>
                            <p class="flex justify-between text-emerald-600 font-medium"><span>Total Payment:</span> <span>{{ number_format($invoice_details?->total_payment ?? 0) }} Tk</span></p>
                            <p class="flex justify-between text-rose-600 font-medium"><span>Total Due:</span> <span>{{ number_format($grand_sub - ($invoice_details?->total_payment ?? 0)) }} Tk</span></p>
                            <p class="flex justify-between mt-1 text-xs text-slate-500"><span>Method:</span> <span class="font-semibold uppercase text-slate-700">{{ $invoice_details?->payment_method ?? 'N/A' }}</span></p>
                        </div>
                    </div>
                </div>

                <!-- 4. Reference Details -->
                <div class="bg-slate-50/70 rounded-xl p-5 border border-slate-200/80 shadow-sm space-y-3">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="p-2 bg-purple-100 text-purple-600 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h3 class="text-base font-semibold text-slate-800">Reference</h3>
                    </div>
                    <div class="text-sm text-slate-600 space-y-2.5">
                        <div>
                            <span class="text-xs text-slate-500 block">Sold By</span>
                            <p class="font-medium text-slate-900">{{ $invoice_details->user?->name ?? 'N/A' }}</p>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block">Sale Date</span>
                            <p class="font-medium text-slate-900">
                                {{ $invoice_details?->sale_date ? date('d-m-Y', strtotime($invoice_details->sale_date)) : 'N/A' }}
                            </p>
                        </div>
                        <div>
                            <span class="text-xs text-slate-500 block mb-1">Payment Status</span>
                            @if(($invoice_details?->total_due ?? 0) > 0)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800 border border-rose-200">
                                    Due
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-200">
                                    Paid
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <!-- Items Table Section -->
            <div class="overflow-x-auto rounded-xl border border-slate-200 shadow-sm">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="text-xs uppercase bg-slate-100/80 text-slate-700 border-b border-slate-200">
                        <tr>
                            <th scope="col" class="px-4 py-3.5 font-semibold">Warehouse</th>
                            <th scope="col" class="px-4 py-3.5 font-semibold">Product</th>
                            <th scope="col" class="px-4 py-3.5 font-semibold">Code</th>
                            <th scope="col" class="px-4 py-3.5 text-right font-semibold">Cost</th>
                            <th scope="col" class="px-4 py-3.5 text-right font-semibold">Price</th>
                            <th scope="col" class="px-4 py-3.5 text-center font-semibold">Qty</th>
                            <th scope="col" class="px-4 py-3.5 text-right font-semibold">Sub Total</th>
                            <th scope="col" class="px-4 py-3.5 text-center font-semibold">Enter Qty</th>
                            <th scope="col" class="px-4 py-3.5 text-center font-semibold">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @php 
                            $total_cost = 0; 
                            $total_price = 0; 
                            $total_sub = 0; 
                            $totalSell = 0; 
                            $total_qty = 0; 
                            $total_payments = 0; 
                            $total_dues = 0; 
                            $total_vat = 0; 
                            $total_discount = 0; 
                        @endphp

                        @foreach($data as $key => $item)
                            @php 
                                $total_vat += $item->sale_vat_amount ?? 0; 
                                $total_discount += $item->sale_discount_amount ?? 0;
                                $totalSell += $item->total_price ?? 0;
                                $total_payments += $item->total_payment ?? 0;
                                $total_dues += $item->total_due ?? 0;
                            @endphp

                            @foreach($item->saleItem ?? [] as $details)
                                <tr class="hover:bg-slate-50/80 transition-colors">
                                    <td class="px-4 py-3.5 font-medium text-slate-900 whitespace-nowrap">{{ $details->warehouse ?? 'N/A' }}</td>
                                    <td class="px-4 py-3.5 font-medium text-slate-800">{{ $details->product ?? 'N/A' }} {{ $details->varient ?? '' }}</td>
                                    <td class="px-4 py-3.5 text-slate-500 font-mono text-xs">{{ $details->code ?? 'N/A' }}</td>
                                    <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                        {{ number_format($details->cost ?? 0) }} Tk
                                        @php $total_cost += ($details->cost ?? 0); @endphp
                                    </td>
                                    <td class="px-4 py-3.5 text-right whitespace-nowrap">
                                        {{ number_format(($details->product_price ?? 0) + ($details->varient_price ?? 0)) }} Tk
                                        @php $total_price += (($details->product_price ?? 0) + ($details->varient_price ?? 0)); @endphp
                                    </td>
                                    <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                        <span class="inline-block bg-slate-100 text-slate-800 px-2 py-0.5 rounded text-xs font-semibold">
                                            {{ $details->total_qty ?? 0 }} pcs
                                        </span>
                                        @php $total_qty += ($details->total_qty ?? 0); @endphp
                                    </td>
                                    <td class="px-4 py-3.5 text-right font-semibold text-slate-900 whitespace-nowrap">
                                        {{ number_format((($details->product_price ?? 0) + ($details->varient_price ?? 0)) * ($details->total_qty ?? 0)) }} Tk
                                        @php $total_sub += (($details->product_price ?? 0) + ($details->varient_price ?? 0)) * ($details->total_qty ?? 0); @endphp
                                    </td>
                                    
                                    <!-- Quantity Form Actions Embedded in Table -->
                                    <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                        <form id="qty-form-{{ $details->id }}" action="{{ route('sale_update', $details->id) }}" method="POST" class="inline-flex items-center">
                                            @csrf
                                            <input type="hidden" name="invoice_id" value="{{ $invoice_details?->id }}">
                                            <input type="number" name="qty" min="1" placeholder="1" class="w-16 px-2 py-1 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent text-center">
                                        </form>
                                    </td>
                                    <td class="px-4 py-3.5 text-center whitespace-nowrap">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <button type="submit" form="qty-form-{{ $details->id }}" name="qty_plus" value="qty_plus" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white font-bold transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-1" title="Increase Quantity">
                                                +
                                            </button>
                                            @if(($details->total_qty ?? 0) > 0)
                                                <button type="submit" form="qty-form-{{ $details->id }}" name="qty_minus" value="qty_minus" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-rose-600 hover:bg-rose-700 text-white font-bold transition-colors shadow-sm focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-1" title="Decrease Quantity">
                                                    -
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach    
                        @endforeach
                    </tbody>
                    <tfoot class="bg-slate-100/90 font-semibold text-slate-900 border-t-2 border-slate-300">
                        <tr>
                            <td class="px-4 py-3.5 uppercase">Total</td>
                            <td class="px-4 py-3.5"></td>
                            <td class="px-4 py-3.5"></td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">{{ number_format($total_cost) }} Tk</td>
                            <td class="px-4 py-3.5 text-right whitespace-nowrap">{{ number_format($total_price) }} Tk</td>
                            <td class="px-4 py-3.5 text-center whitespace-nowrap">{{ number_format($total_qty) }} Pcs</td>
                            <td class="px-4 py-3.5 text-right text-indigo-700 whitespace-nowrap">{{ number_format($total_sub) }} Tk</td>
                            <td class="px-4 py-3.5"></td>
                            <td class="px-4 py-3.5"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Invoice Grand Calculations Box -->
            <div class="flex justify-end">
                <div class="w-full max-w-md bg-slate-50/80 rounded-xl p-5 border border-slate-200 shadow-sm space-y-2 text-sm">
                    <div class="flex justify-between text-slate-700">
                        <span>Sub Total:</span>
                        <span class="font-semibold text-slate-900">{{ number_format($total_sub) }} Tk</span>
                    </div>
                    <div class="flex justify-between text-slate-700">
                        <span>(+) Vat:</span>
                        <span class="font-semibold text-slate-900">{{ number_format($invoice_details?->sale_vat_amount ?? 0) }} Tk</span>
                    </div>
                    <div class="flex justify-between text-slate-700">
                        <span>(-) Discount:</span>
                        <span class="font-semibold text-slate-900">{{ number_format($invoice_details?->sale_discount_amount ?? 0) }} Tk</span>
                    </div>
                    
                    @php 
                        $grand = $total_sub + ($invoice_details?->sale_vat_amount ?? 0) - ($invoice_details?->sale_discount_amount ?? 0); 
                    @endphp
                    
                    <div class="border-t border-slate-300 pt-3 mt-2 space-y-2">
                        <div class="flex justify-between text-base font-bold text-slate-900">
                            <span>Total:</span>
                            <span class="text-indigo-600">{{ number_format($grand) }} Tk</span>
                        </div>
                        <div class="flex justify-between text-sm font-semibold text-emerald-600">
                            <span>Total Payment:</span>
                            <span>{{ number_format($invoice_details?->total_payment ?? 0) }} Tk</span>
                        </div>
                        <div class="flex justify-between text-sm font-semibold text-rose-600">
                            <span>Total Due:</span>
                            <span>{{ number_format($grand - ($invoice_details?->total_payment ?? 0)) }} Tk</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection