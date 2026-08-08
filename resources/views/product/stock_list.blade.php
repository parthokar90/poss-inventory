@extends('admin.layouts.master')

@section('title') Dashboard | Stock List @endsection

{{-- Include DataTables Tailwind CSS in Header/Styles --}}
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
    /* Custom override for DataTables controls to fit Tailwind layout */
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
        ring: 2px;
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
    <div class="mb-6">
        <h1 class="text-2xl font-bold tracking-tight text-gray-800 uppercase">Stock List</h1>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        {{-- Card Header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between px-6 py-4 border-b border-gray-200 bg-gray-50 gap-4">
            <h2 class="text-md font-semibold text-gray-800 uppercase">Stock Information</h2>
            
            {{-- Optional Backend Search Form --}}
            <form method="GET" action="{{ route('item_stock_search') }}" class="flex items-center space-x-2">
                <input 
                    type="text" 
                    name="search" 
                    placeholder="Search product code or name..." 
                    autocomplete="off" 
                    required
                    class="px-3 py-1.5 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                <button type="submit" class="px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded-md shadow-sm hover:bg-green-700 transition flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    <span>Search</span>
                </button>
            </form>
        </div>

        {{-- Card Body --}}
        <div class="p-6">
            <div class="overflow-x-auto">
                <table id="stock_table" class="min-w-full divide-y divide-gray-200 text-left text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">#</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Product Code</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Product</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Warehouse Breakdown</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Total Stock</th>
                            <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if($list->count() > 0)
                            @foreach($list as $key => $item)
                                @php $total_stock = 0; @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500 font-medium">{{ ++$key }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-800 font-semibold">{{ $item->product_code }}</td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-800">{{ $item->product_name }}</td>
                                    <td class="px-4 py-3">
                                        {{-- Clean Warehouse Badges Layout --}}
                                        <div class="flex flex-wrap gap-1.5">
                                            @foreach($item->productWarehouses as $warehouse)
                                                @php $total_stock += $warehouse->qty; @endphp
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                                    {{ optional($warehouse->Warehouses)->name }}: <strong class="ml-1">{{ $warehouse->qty }}</strong>
                                                </span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $total_stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $total_stock }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-center">
                                        <a href="{{ route('product.edit', $item->id) }}" title="Edit Product" class="inline-flex items-center p-1.5 text-blue-600 hover:text-blue-900 bg-blue-50 hover:bg-blue-100 rounded-md transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
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
        $('#stock_table').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [10, 25, 50, 100],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Filter stock list...",
                emptyTable: "No stock data available"
            }
        });
    });
</script>
@endsection