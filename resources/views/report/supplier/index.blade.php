@extends('admin.layouts.master')
@section('title') Dashboard | Supplier Report @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    @include('admin.includes.messages')

    <!-- Header Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Supplier Report</h2>
    </div>

    <!-- Main Card Container -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Card Header -->
        <div class="flex items-center justify-between border-b border-gray-200 px-6 py-4 bg-gray-50">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Supplier Report</h2>

            <!-- Action Dropdown -->
            <div class="relative inline-block text-left" x-data="{ open: false }">
                <button @click="open = !open" type="button" class="text-gray-500 hover:text-gray-700 focus:outline-none p-1 rounded-full hover:bg-gray-200 transition">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z" />
                    </svg>
                </button>
                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-10">
                    <div class="py-1">
                        <a href="{{ route('units.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition">Add Unit</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <!-- Supplier Filter Section Start -->
            <div id="supplier_div" class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                <form method="post" action="{{ route('supplier_reports_generate') }}">
                    @csrf 
                    <!-- Form Controls Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        
                        <!-- Report Type Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Report Type</label>
                            <select class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" name="report_type">
                                <option value="1">Purchase Report</option>
                                <option value="2">Payment Report</option>
                            </select>
                        </div>

                        <!-- Supplier Selection -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Select Supplier</label>
                            <select id="supplier_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" name="supplier_id" required>
                                <option value="">Select</option>
                                @foreach($supplier as $suppliers)
                                    <option value="{{ $suppliers->id }}">{{ $suppliers->supplier_name }}</option>
                                @endforeach   
                            </select>
                        </div>

                        <!-- Start Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" type="date" name="start" value="{{ date('Y-m-01') }}">
                        </div>

                        <!-- End Date -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" type="date" name="end" value="{{ date('Y-m-t') }}"> 
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-3">
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 shadow-sm transition">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Search
                        </button>

                        <button type="submit" name="pdf_download" value="pdf_download" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 shadow-sm transition">
                            Download PDF
                        </button>
                    </div> 
                </form>
            </div>
            <!-- Supplier Filter Section End -->
        </div>
    </div>
</div>

<!-- Select2 Initialization Script -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $("#supplier_id").select2({ width: '100%' });
        $("#warehouse_id").select2({ width: '100%' });
    });
</script>
@endsection