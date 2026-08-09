@extends('admin.layouts.master')

@section('title') Dashboard | Purchase List @endsection

{{-- Include DataTables Tailwind CSS in Header --}}
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* Custom style overrides for DataTables controls */
    .dataTables_wrapper .dataTables_length select,
    .dataTables_wrapper .dataTables_filter input {
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
        font-size: 0.875rem;
        outline: none;
    }
    .dataTables_wrapper .dataTables_filter input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
    }
    .dataTables_wrapper .dataTables_info,
    .dataTables_wrapper .dataTables_paginate {
        font-size: 0.875rem;
        color: #4b5563;
        margin-top: 1rem;
    }
</style>
@endsection

@section('content')
<div class="w-full px-4 py-6 mx-auto">
    @include('admin.includes.messages')

    {{-- Page Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-800 uppercase">Purchase Management</h1>
            <p class="text-sm text-gray-500">View and filter purchase invoices and supplier payments</p>
        </div>
        <a href="{{ route('purchase.create') }}" class="inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-700 transition gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Add Purchase</span>
        </a>
    </div>

    {{-- Main Filter & Table Card --}}
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden mb-6">
        
        {{-- Filter Forms Section --}}
        <div class="p-6 border-b border-gray-200 bg-gray-50/50">
            <h2 class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-4">Filter & Search Purchases</h2>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Form 1: Search by Invoice or Status --}}
                <div class="bg-white p-4 rounded-md border border-gray-200 shadow-sm flex flex-col justify-between">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Search Invoice / Status</label>
                    <form method="GET" action="{{ route('purchase.index') }}" class="flex items-center gap-2">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Invoice No or Status" 
                            autocomplete="off" 
                            required
                            class="w-full px-3 py-1.5 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <button type="submit" name="search_item" value="all_search" class="px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700 transition flex items-center shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </form>
                </div>

                {{-- Form 2: Filter by Supplier & Single Date --}}
                <div class="bg-white p-4 rounded-md border border-gray-200 shadow-sm">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Supplier & Date Filter</label>
                    <form method="GET" action="{{ route('purchase.index') }}" class="space-y-2">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <select name="supplier_id" id="supplier_add" class="w-full px-2 py-1.5 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    @foreach($supplier as $suppliers)
                                        <option value="{{ $suppliers->id }}" selected>{{ $suppliers->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <input type="date" name="purchase_date" value="{{ date('Y-m-d') }}" autocomplete="off" class="w-full px-2 py-1.5 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="submit" name="search_item" value="supplier_search" class="w-full px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700 transition flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Filter Supplier</span>
                        </button>
                    </form>
                </div>

                {{-- Form 3: Filter by Date Range --}}
                <div class="bg-white p-4 rounded-md border border-gray-200 shadow-sm">
                    <label class="block text-xs font-semibold text-gray-600 uppercase mb-2">Date Range Filter</label>
                    <form method="GET" action="{{ route('purchase.index') }}" class="space-y-2">
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <input type="date" name="start" value="{{ date('Y-m-01') }}" autocomplete="off" required class="w-full px-2 py-1.5 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <input type="date" name="end" value="{{ date('Y-m-t') }}" autocomplete="off" required class="w-full px-2 py-1.5 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        <button type="submit" name="search_item" value="date_search" class="w-full px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700 transition flex items-center justify-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <span>Filter Dates</span>
                        </button>
                    </form>
                </div>

            </div>
        </div>

        {{-- Table Container --}}
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="purchase_table" class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">#</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Invoice</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Discount</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">VAT</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Supplier</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Date</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Purchased By</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Total</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Payment</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Due</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Status</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($list->count() > 0)
                            @foreach($list as $key => $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500 font-medium">{{ ++$key }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap font-semibold text-amber-600">Invoice-{{ $item->id }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $item->purchase_discount }}%</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-700">{{ $item->purchase_vat }}%</td>
                                    <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-800">{{ optional($item->suppliers)->supplier_name }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-600">{{ $item->purchase_date }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-600">{{ optional($item->user)->name }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap font-medium text-gray-900">{{ number_format($item->total_price) }} Tk</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-green-600 font-medium">{{ number_format($item->total_payment) }} Tk</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-red-600 font-medium">{{ number_format($item->total_due) }} Tk</td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                            {{ $item->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center space-x-2">
                                            <a href="{{ route('purchase.show', $item->id) }}" title="View Purchase Item" class="p-1.5 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 rounded-md transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('purchase.edit', $item->id) }}" title="Edit Purchase Item" class="p-1.5 text-amber-600 hover:text-amber-900 bg-amber-50 hover:bg-amber-100 rounded-md transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize jQuery DataTables
        $('#purchase_table').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Filter table records...",
                emptyTable: "No purchase data available"
            }
        });
    });
</script>
@endsection