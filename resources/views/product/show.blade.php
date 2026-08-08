@extends('admin.layouts.master')
@section('title') Product Details | {{ $product->product_name }} @endsection

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header with Back Button -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">PRODUCT DETAILS</h2>
            <p class="text-sm text-slate-500">Full information for {{ $product->product_name }}</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('product.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium py-2 px-4 rounded-lg transition duration-200 inline-flex items-center gap-2 text-sm">
                <i class="fa-solid fa-arrow-left"></i> Back to List
            </a>
            <a href="{{ route('product.edit', $product->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-200 inline-flex items-center gap-2 text-sm">
                <i class="fa-solid fa-pen-to-square"></i> Edit Product
            </a>
        </div>
    </div>

    <!-- Product Card -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Overview Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 lg:col-span-1">
            <div class="flex flex-col items-center text-center">
                <div class="w-20 h-20 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-3xl font-bold mb-4 border border-blue-100">
                    <i class="fa-solid fa-box-open"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-1">{{ $product->product_name }}</h3>
                <span class="inline-block bg-slate-100 text-slate-600 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                    Code: {{ $product->product_code }}
                </span>

                <div class="w-full border-t border-slate-100 pt-4 mt-2">
                    <div class="flex justify-between items-center py-2 text-sm">
                        <span class="text-slate-500">Category:</span>
                        <span class="font-semibold text-emerald-600 bg-emerald-50 px-2.5 py-0.5 rounded-md">
                            {{ $product->category?->category_name ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2 text-sm">
                        <span class="text-slate-500">Brand:</span>
                        <span class="font-medium text-slate-700">
                            {{ $product->brand?->brand_name ?? 'N/A' }}
                        </span>
                    </div>
                    <div class="flex justify-between items-center py-2 text-sm">
                        <span class="text-slate-500">Unit:</span>
                        <span class="font-medium text-slate-700">
                            {{ $product->unit?->unit_name ?? 'Pcs' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Card -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 lg:col-span-2">
            <h4 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-6">
                Pricing & Financial Information
            </h4>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
                <div class="p-4 rounded-xl bg-slate-50 border border-slate-100">
                    <p class="text-xs text-slate-500 font-medium uppercase tracking-wider mb-1">Product Cost</p>
                    <p class="text-2xl font-bold text-slate-700">{{ number_format($product->product_cost, 2) }} <span class="text-sm font-normal text-slate-500">Tk</span></p>
                </div>

                <div class="p-4 rounded-xl bg-blue-50/50 border border-blue-100">
                    <p class="text-xs text-blue-600 font-medium uppercase tracking-wider mb-1">Selling Price</p>
                    <p class="text-2xl font-bold text-blue-600">{{ number_format($product->product_price, 2) }} <span class="text-sm font-normal text-blue-500">Tk</span></p>
                </div>
            </div>

            <!-- Calculated Profit Margin -->
            @php
                $profit = $product->product_price - $product->product_cost;
                $margin = $product->product_cost > 0 ? ($profit / $product->product_cost) * 100 : 0;
            @endphp
            <div class="p-4 rounded-xl bg-emerald-50/60 border border-emerald-100 mb-6 flex justify-between items-center">
                <div>
                    <p class="text-xs text-emerald-700 font-medium uppercase tracking-wider">Estimated Profit Margin</p>
                    <p class="text-lg font-bold text-emerald-700">{{ number_format($profit, 2) }} Tk / unit</p>
                </div>
                <span class="bg-emerald-600 text-white text-xs font-bold px-3 py-1.5 rounded-lg">
                    {{ number_format($margin, 1) }}%
                </span>
            </div>

            <h4 class="text-lg font-bold text-slate-800 border-b border-slate-100 pb-3 mb-4">
                Description & Additional Details
            </h4>
            <div class="text-slate-600 text-sm leading-relaxed">
                {{ $product->product_details ?? $product->description ?? 'No description available for this product.' }}
            </div>
        </div>
    </div>
</div>
@endsection