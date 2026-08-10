@extends('admin.layouts.master')
@section('title', 'Dashboard | Add Quotation')

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Page Header --}}
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Quotation</h1>
            <p class="text-sm text-gray-500">Create a new customer quotation record</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('quotations.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium text-sm rounded-lg transition-colors">
                Quotation List
            </a>
            <a href="{{ route('quotations.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors">
                + Add Quotation
            </a>
        </div>
    </div>

    {{-- Form Container Card --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-5 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800 uppercase">Create Quotation Information</h2>
        </div>

        <form action="{{ route('quotations.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            {{-- Row 1: Date, Reference, Biller, Tax --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Quotation Date --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Quotation Date <span class="text-red-500">*</span></label>
                    <input type="date" name="quotation_date" value="{{ old('quotation_date') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                    @error('quotation_date')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Reference No --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Reference No</label>
                    <input type="text" name="reference_no" value="{{ old('reference_no') }}" autocomplete="off" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>

                {{-- Biller --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Biller <span class="text-red-500">*</span></label>
                    <select id="item_add" name="product_id" required class="w-full text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Biller</option>
                    </select>
                </div>

                {{-- Tax --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tax <span class="text-red-500">*</span></label>
                    <select id="tax_add" name="product_id" required class="w-full text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Tax</option>
                    </select>
                </div>
            </div>

            {{-- Row 2: Discount, Shipping, Status, Supplier --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Discount --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Discount</label>
                    <input type="text" name="discount" autocomplete="off" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>

                {{-- Shipping --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Shipping</label>
                    <input type="text" name="shipping" autocomplete="off" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                    <select name="status" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        <option value="">Select Status</option>
                        <option value="pending">Pending</option>
                        <option value="sent">Sent</option>
                    </select>
                </div>

                {{-- Supplier --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Supplier <span class="text-red-500">*</span></label>
                    <select id="supplier_add" name="supplier_id" required class="w-full text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Supplier</option>
                    </select>
                </div>
            </div>

            {{-- Row 3: Warehouse & Customer --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Warehouse --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Warehouse <span class="text-red-500">*</span></label>
                    <select id="warehouse_id" name="warehouse_id" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        <option value="">Select Warehouse</option>
                        @foreach($warehouse as $warehouses)
                            <option value="{{ $warehouses->id }}">{{ $warehouses->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Customer --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Customer <span class="text-red-500">*</span></label>
                    <select id="customer_add" name="customer_id" required class="w-full text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Customer</option>
                    </select>
                </div>
            </div>

            {{-- Row 4: Product Selector --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Product <span class="text-red-500">*</span></label>
                <div class="flex gap-3">
                    <select id="product_id" name="product_id" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition-all">
                        <option value="">Select Warehouse First</option>
                    </select>
                    <button type="button" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition-colors">
                        +
                    </button>
                </div>
            </div>

            {{-- Submit Action --}}
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors">
                    Save Quotation
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 selectors safely
        $("#item_add").select2({ placeholder: "Select option", width: '100%' });
        $("#tax_add").select2({ placeholder: "Select option", width: '100%' });
        $("#supplier_add").select2({ placeholder: "Select option", width: '100%' });
        $("#customer_add").select2({ placeholder: "Select option", width: '100%' });

        // AJAX call to load products dynamically on Warehouse change
        $("#warehouse_id").on("change", function() {
            var warehouseId = $(this).val();

            if (!warehouseId) {
                $("#product_id").html('<option value="">Select Warehouse First</option>');
                return;
            }

            $.ajax({
                url: "{{ url('/warehouse_product/') }}/" + warehouseId,
                type: "GET",
                success: function(response) {
                    var options = '<option value="">Select Product</option>';
                    $.each(response, function(index, item) {
                        options += '<option value="' + item.id + '">' + item.product_name + '</option>';
                    });
                    $("#product_id").html(options);
                },
                error: function(error) {
                    console.error("Failed to fetch warehouse products:", error);
                }
            });
        });
    });
</script>
@endsection