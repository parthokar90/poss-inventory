@extends('admin.layouts.master')

@section('title', 'Dashboard | Purchase Report')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Flash Messages -->
    @include('admin.includes.messages')

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Expense</h2>
    </div>

    <!-- Main Card Content -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <!-- Card Header -->
        <div class="p-6 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Purchase Report</h2>

            <!-- Action Button -->
            <div>
                <a href="{{ route('units.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Unit
                </a>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6 space-y-8">

            <!-- Supplier Filter Section -->
            <div id="supplier_div" class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 uppercase mb-4 tracking-wider">Filter By Supplier</h3>
                <form method="POST" action="{{ route('purchase_reports_show_supplier') }}">
                    @csrf 

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-5">
                        <!-- Supplier Select -->
                        <div>
                            <label for="supplier_id" class="block text-sm font-medium text-gray-700 mb-1">Select Supplier <span class="text-red-500">*</span></label>
                            <select id="supplier_id" name="supplier_id" required 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                                <option value="">Select</option>
                                @foreach($supplier as $suppliers)
                                    <option value="{{ $suppliers->id }}">{{ $suppliers->supplier_name }}</option>
                                @endforeach   
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label for="supplier_start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input id="supplier_start_date" type="date" name="start" value="{{ date('Y-m-01') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="supplier_end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input id="supplier_end_date" type="date" name="end" value="{{ date('Y-m-t') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>

                        <button type="submit" name="pdf_download" value="pdf_download" 
                                class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </button>
                    </div>
                </form>
            </div>

            <!-- All Purchase Reports Filter Section -->
            <div id="date_div" class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 uppercase mb-4 tracking-wider">Filter All Purchases By Date</h3>
                <form method="POST" action="{{ route('purchase_reports_show_all') }}">
                    @csrf 

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                        <!-- Start Date -->
                        <div>
                            <label for="all_start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input id="all_start_date" type="date" name="start" value="{{ date('Y-m-01') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        </div>

                        <!-- End Date -->
                        <div>
                            <label for="all_end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input id="all_end_date" type="date" name="end" value="{{ date('Y-m-t') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center gap-3">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Search
                        </button>

                        <button type="submit" name="pdf_download" value="pdf_download" 
                                class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download PDF
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- Scripts Section -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Select2 with 100% width for responsive alignment
        $("#supplier_id").select2({
            width: '100%'
        });
    });
</script>
@endsection