@extends('admin.layouts.master')
@section('title') Dashboard | Sell Report @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    @include('admin.includes.messages')

    <!-- Header Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Sell</h2>
    </div>

    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-6">
        <!-- Card Header -->
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Sell Report</h2>

            <!-- Action Dropdown -->
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none p-1 rounded-full hover:bg-gray-200">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1">
                        <a href="{{ route('units.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Add Unit</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-8">
            <!-- Filter Form: By Customer -->
            <div id="supplier_div" class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-md font-medium text-gray-700 mb-4">Filter Sales by Customer</h3>
                <form method="post" action="{{ route('sale_reports_show_customer') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <!-- Customer Select -->
                        <div>
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Select Customer</label>
                            <select id="supplier_id" name="supplier_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                                <option value="">Select</option>
                                @foreach($customer as $customers)
                                    <option value="{{ $customers->id }}">{{ $customers->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="date" name="start" value="{{ date('Y-m-01') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>

                        <!-- End Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="date" name="end" value="{{ date('Y-m-t') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search
                        </button>

                        <button type="submit" name="pdf_download" value="pdf_download" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-sm">
                            Download PDF
                        </button>
                    </div>
                </form>
            </div>

            <!-- Filter Form: All Sales -->
            <div id="date_div" class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                <h3 class="text-md font-medium text-gray-700 mb-4">Filter All Sales</h3>
                <form method="post" action="{{ route('sale_reports_show_all') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <!-- Start Date -->
                        <div>
                            <label for="all_start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input id="all_start_date" type="date" name="start" value="{{ date('Y-m-01') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="all_end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input id="all_end_date" type="date" name="end" value="{{ date('Y-m-t') }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search
                        </button>

                        <button type="submit" name="pdf_download" value="pdf_download" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-sm">
                            Download PDF
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Select2 Script Initialization -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#supplier_id").select2({ width: '100%' });
    });
</script>
@endsection