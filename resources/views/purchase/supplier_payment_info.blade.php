@extends('admin.layouts.master')

@section('title') Dashboard | Add Supplier Payment @endsection

@section('content')
<!-- Include Select2 Styles -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    /* Custom Styling for Select2 inside Tailwind Form */
    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single {
        height: 42px !important;
        border: 1px solid #D1D5DB !important;
        border-radius: 0.5rem !important;
        padding-top: 6px !important;
        padding-left: 6px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
        right: 8px !important;
    }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    @include('admin.includes.messages')

    <!-- Header Section -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800">SUPPLIER PAYMENT</h1>
            <p class="text-sm text-gray-500">Filter purchases and issue payments to suppliers</p>
        </div>

        <!-- Quick Links Menu -->
        <div class="flex items-center gap-2">
            <a href="{{ route('purchase.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-colors">
                Purchase List
            </a>
            <a href="{{ route('purchase.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition-colors">
                + Add Purchase
            </a>
        </div>
    </div>

    <!-- Main Card Body -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-base font-bold text-gray-800">CREATE SUPPLIER PAYMENT</h2>
        </div>

        <div class="p-6">
            <form method="POST" action="{{ route('payment-supplier.store') }}">
                @csrf 

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <!-- Supplier Selection Field -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-2">Supplier *</label>
                        <select name="supplier_id" id="supplier_select">
                            @foreach($supplier as $suppliers)
                                <option value="{{ $suppliers->id }}">{{ $suppliers->supplier_name }}</option>
                            @endforeach  
                        </select>
                    </div>

                    <!-- Start Date Field -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-2">Start Date *</label>
                        <input type="date" name="start" value="{{ date('Y-m-01') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500 border p-2.5">
                    </div>

                    <!-- End Date Field -->
                    <div>
                        <label class="block text-xs font-bold uppercase text-gray-700 mb-2">End Date *</label>
                        <input type="date" name="end" value="{{ date('Y-m-t') }}" required class="w-full rounded-lg border-gray-300 text-sm focus:ring-indigo-500 focus:border-indigo-500 border p-2.5">
                    </div>
                </div>

                <!-- Submit Action Button -->
                <div class="flex justify-start">
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-lg transition-colors shadow-sm inline-flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Search Purchases
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Essential Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 dropdown for supplier selection
        $('#supplier_select').select2({
            placeholder: "Select Supplier",
            allowClear: true
        });
    });
</script>
@endsection