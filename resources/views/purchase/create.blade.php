@extends('admin.layouts.master')
@section('title') Purchase Create @endsection

@section('content')
<!-- Essential CSS Libraries -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<style>
    .select2-container {
        width: 100% !important;
    }
    .select2-container--default .select2-selection--single {
        height: 42px !important;
        border: 1px solid #D1D5DB !important;
        border-radius: 0.5rem !important;
        padding-top: 6px !important;
        padding-left: 6px !important;
        background-color: #ffffff !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 40px !important;
        right: 8px !important;
    }
    .select2-dropdown {
        border-color: #D1D5DB !important;
        border-radius: 0.5rem !important;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
        z-index: 9999 !important;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
        margin: 0;
    }
</style>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    
    <!-- Page Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-gray-800">Create New Purchase</h1>
            <p class="text-sm text-gray-500">Select product to add items and manage quantities seamlessly</p>
        </div>
    </div>

    <form action="{{ route('purchase.store') }}" method="POST" id="purchase-form" class="space-y-6">
        @csrf

        <!-- SECTION 1: Product Selection Bar & Primary Info -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-5 space-y-5">
            
            <!-- Product Select Box -->
            <div class="bg-indigo-50/50 p-4 rounded-xl border border-indigo-100">
                <label class="block text-sm font-bold text-indigo-900 mb-2">1. Select Product to Add *</label>
                <select id="product_selector" class="w-full">
                    <option value="">Search or Select Product by Name or Code...</option>
                    @foreach($product as $item)
                        <option value="{{ $item->id }}" 
                                data-name="{{ $item->product_name }}" 
                                data-code="{{ $item->product_code }}" 
                                data-price="{{ $item->product_price ?? 0 }}"
                                data-cost="{{ $item->purchase_price ?? 0 }}"
                                data-tax="{{ $item->tax ?? 0 }}">
                            {{ $item->product_name }} (Code: {{ $item->product_code }})
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Basic Info Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">2. Purchase Date *</label>
                    <input type="date" name="purchase_date" value="{{ date('Y-m-d') }}" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2.5 border">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">3. Supplier *</label>
                    <select name="supplier_id" class="custom-select2 w-full" required>
                        <option value="">Select Supplier</option>
                        @foreach($supplier as $sup)
                            <option value="{{ $sup->id }}">{{ $sup->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">4. Purchase Status *</label>
                    <select name="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2.5 border bg-white" required>
                        <option value="Received">Received</option>
                        <option value="Pending">Pending</option>
                        <option value="Ordered">Ordered</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">5. Payment Status *</label>
                    <select name="payment_status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2.5 border bg-white" required>
                        <option value="Paid">Paid</option>
                        <option value="Due">Due</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- SECTION 2: Dynamic Purchase Table -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="p-4 bg-gray-50 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-base font-bold text-gray-800 flex items-center gap-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"></path></svg>
                    Purchase Item List
                </h3>
                <span id="item-count-badge" class="text-xs bg-indigo-100 text-indigo-800 font-bold px-3 py-1 rounded-full">0 Items</span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs uppercase bg-gray-100 text-gray-700 font-semibold border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3">Product Details</th>
                            <th class="px-3 py-3 w-28 text-right">Cost (Tk)</th>
                            <th class="px-3 py-3 w-28 text-right">Sale Price (Tk)</th>
                            <th class="px-3 py-3 w-20 text-center">Tax (%)</th>
                            <th class="px-3 py-3 w-24 text-right">Tax Amt</th>
                            <th class="px-3 py-3 w-32">Warehouse</th>
                            <th class="px-3 py-3 w-28">Variant</th>
                            <th class="px-3 py-3 w-36 text-center">Quantity</th>
                            <th class="px-4 py-3 w-32 text-right">Subtotal</th>
                            <th class="px-3 py-3 text-center w-16">Action</th>
                        </tr>
                    </thead>
                    <tbody id="purchase_items_body" class="divide-y divide-gray-200 bg-white">
                        <!-- Items will dynamically append here -->
                    </tbody>
                </table>

                <!-- Empty State Message -->
                <div id="empty-table-msg" class="text-center py-12 bg-gray-50/50">
                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                    <p class="mt-2 text-sm font-medium text-gray-500">No products added yet.</p>
                    <p class="text-xs text-gray-400">Select a product from the top dropdown to start adding items.</p>
                </div>
            </div>
        </div>

        <!-- SECTION 3: Calculations & Order Summary -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Left Side Inputs -->
            <div class="lg:col-span-7 bg-white rounded-2xl shadow-sm border border-gray-200 p-5 space-y-4">
                <h4 class="text-sm font-bold text-gray-800 border-b border-gray-100 pb-2">Additional Charges & Notes</h4>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">VAT (%)</label>
                        <input type="number" name="vat" id="vat_input" min="0" value="0" step="0.01" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2.5 border">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Discount (%)</label>
                        <input type="number" name="discount" id="discount_input" min="0" value="0" step="0.01" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2.5 border">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Paid Payment (Tk)</label>
                    <input type="number" name="purchase_payment" id="payment_input" min="0" value="0" step="0.01" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2.5 border font-semibold text-emerald-600">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase mb-1">Note / Remarks</label>
                    <textarea name="purchase_note" rows="3" placeholder="Add any specific notes or instructions for this purchase..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm p-2.5 border"></textarea>
                </div>
            </div>

            <!-- Right Side Summary Box -->
            <div class="lg:col-span-5 flex flex-col justify-between bg-slate-900 rounded-2xl p-6 text-white shadow-lg">
                <div class="space-y-4">
                    <h4 class="text-base font-bold border-b border-slate-800 pb-3 flex justify-between items-center">
                        <span>Payment Summary</span>
                        <span class="text-xs bg-slate-800 text-indigo-300 px-2.5 py-1 rounded-full font-normal">Calculated Live</span>
                    </h4>
                    
                    <div class="flex justify-between items-center text-sm text-slate-300">
                        <span>Items Subtotal:</span>
                        <span class="font-semibold text-white"><span id="summary_subtotal">0.00</span> Tk</span>
                    </div>

                    <div class="flex justify-between items-center text-sm text-slate-300">
                        <span>Tax Total:</span>
                        <span class="font-semibold text-white">+ <span id="summary_tax">0.00</span> Tk</span>
                    </div>

                    <div class="flex justify-between items-center text-sm text-slate-300">
                        <span>VAT Amount:</span>
                        <span class="font-semibold text-white">+ <span id="summary_vat">0.00</span> Tk</span>
                    </div>

                    <div class="flex justify-between items-center text-sm text-slate-300">
                        <span>Discount Amount:</span>
                        <span class="font-semibold text-red-400">- <span id="summary_discount">0.00</span> Tk</span>
                    </div>

                    <div class="pt-4 border-t border-slate-800 flex justify-between items-center text-lg font-extrabold">
                        <span>Grand Total:</span>
                        <span class="text-indigo-400 text-xl"><span id="summary_grand_total">0.00</span> Tk</span>
                    </div>

                    <div class="flex justify-between items-center text-sm text-slate-400 pt-1">
                        <span>Due Amount:</span>
                        <span class="font-bold text-amber-400"><span id="summary_due">0.00</span> Tk</span>
                    </div>
                </div>

                <button type="submit" class="mt-6 w-full py-3.5 bg-indigo-600 hover:bg-indigo-500 active:bg-indigo-700 text-white font-bold text-base rounded-xl transition-all duration-150 shadow-md flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Complete Purchase
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Essential Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    
    // Initialize Select2
    $('#product_selector').select2({
        placeholder: "Search or Select Product...",
        allowClear: true
    });
    
    $('.custom-select2').select2({
        placeholder: "Select Option"
    });

    // 1. ADD PRODUCT TO TABLE
    $('#product_selector').on('change', function () {
        let productId = $(this).val();
        if (!productId) return;

        let selectedOption = $(this).find('option:selected');
        let name = selectedOption.attr('data-name') || '';
        let code = selectedOption.attr('data-code') || '';
        let cost = parseFloat(selectedOption.attr('data-cost')) || 0;
        let price = parseFloat(selectedOption.attr('data-price')) || 0;
        let tax = parseFloat(selectedOption.attr('data-tax')) || 0;

        // If product already exists, increase quantity
        if ($('#row_' + productId).length > 0) {
            let qtyInput = $('#row_' + productId).find('.row-qty');
            let newQty = (parseInt(qtyInput.val()) || 0) + 1;
            qtyInput.val(newQty).trigger('change');
            $('#product_selector').val('').trigger('change.select2');
            return;
        }

        let taxAmt = (price * (tax / 100)).toFixed(2);
        // Subtotal calculated purely from Price * Quantity (1)
        let lineSubtotal = (price * 1).toFixed(2);

        let tr = `
            <tr id="row_${productId}" class="item-row hover:bg-gray-50/80 transition-colors">
                <td class="px-4 py-3">
                    <div class="font-bold text-gray-900">${name}</div>
                    <div class="text-xs text-gray-400">Code: ${code}</div>
                    <input type="hidden" name="product_id[]" value="${productId}">
                    <input type="hidden" name="cost_price[]" value="${cost}">
                    <input type="hidden" name="sale_price[]" class="row-price-val" value="${price}">
                </td>
                <td class="px-3 py-3 text-right font-medium text-gray-700">
                    ${cost.toFixed(2)} Tk
                </td>
                <td class="px-3 py-3 text-right font-semibold text-gray-800">
                    ${price.toFixed(2)} Tk
                </td>
                <td class="px-3 py-3 text-center">
                    <input type="number" step="0.01" min="0" name="tax_percent[]" value="${tax}" class="row-tax w-full border-gray-300 rounded-lg p-1.5 text-sm border focus:ring-1 focus:ring-indigo-500 text-center">
                </td>
                <td class="px-3 py-3 text-right font-medium text-gray-700">
                    <span class="row-tax-amt">${taxAmt}</span> Tk
                </td>
                <td class="px-3 py-3">
                    <select name="warehouse_id[]" class="w-full border-gray-300 rounded-lg p-1.5 text-sm border">
                        <option value="1">Main Warehouse</option>
                    </select>
                </td>
                <td class="px-3 py-3">
                    <select name="variant_id[]" class="w-full border-gray-300 rounded-lg p-1.5 text-sm border">
                        <option value="">Default</option>
                    </select>
                </td>
                <td class="px-3 py-3">
                    <div class="flex items-center justify-center space-x-1 bg-gray-100 p-1 rounded-lg border border-gray-200">
                        <button type="button" class="btn-qty-minus text-gray-600 hover:bg-white hover:shadow-sm w-7 h-7 rounded font-bold transition-all">-</button>
                        <input type="number" min="1" name="quantity[]" value="1" class="row-qty w-12 text-center border-0 bg-transparent text-sm font-bold focus:ring-0 p-0">
                        <button type="button" class="btn-qty-plus text-gray-600 hover:bg-white hover:shadow-sm w-7 h-7 rounded font-bold transition-all">+</button>
                    </div>
                </td>
                <td class="px-4 py-3 font-bold text-indigo-600 text-right">
                    <span class="row-subtotal">${lineSubtotal}</span> Tk
                </td>
                <td class="px-3 py-3 text-center">
                    <button type="button" class="remove-btn text-red-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition-colors" title="Remove Product">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </td>
            </tr>
        `;

        $('#purchase_items_body').append(tr);
        $('#product_selector').val('').trigger('change.select2');
        
        calculateTotals();
    });

    // 2. QUANTITY BUTTONS
    $(document).on('click', '.btn-qty-plus', function() {
        let input = $(this).siblings('.row-qty');
        let currentVal = parseInt(input.val()) || 0;
        input.val(currentVal + 1).trigger('change');
    });

    $(document).on('click', '.btn-qty-minus', function() {
        let input = $(this).siblings('.row-qty');
        let currentVal = parseInt(input.val()) || 1;
        if (currentVal > 1) {
            input.val(currentVal - 1).trigger('change');
        }
    });

    // 3. REMOVE ITEM
    $(document).on('click', '.remove-btn', function() {
        $(this).closest('tr').remove();
        calculateTotals();
    });

    // 4. LIVE INPUT EVENT LISTENER
    $(document).on('input change keyup', '.row-tax, .row-qty, #vat_input, #discount_input, #payment_input', function() {
        let row = $(this).closest('tr');
        if (row.length > 0) {
            recalculateRow(row);
        }
        calculateTotals();
    });

    // Single Row Calculation Logic (Subtotal = Price * Qty)
    function recalculateRow(row) {
        let price = parseFloat(row.find('.row-price-val').val()) || 0;
        let tax = parseFloat(row.find('.row-tax').val()) || 0;
        let qty = parseInt(row.find('.row-qty').val()) || 0;

        let lineSubtotal = price * qty;
        let taxAmt = lineSubtotal * (tax / 100);

        row.find('.row-tax-amt').text(taxAmt.toFixed(2));
        row.find('.row-subtotal').text(lineSubtotal.toFixed(2));
    }

    // 5. GRAND TOTAL & SUMMARY CALCULATION
    function calculateTotals() {
        let itemsSubtotal = 0;
        let totalTax = 0;
        let count = 0;

        $('.item-row').each(function() {
            count++;
            let price = parseFloat($(this).find('.row-price-val').val()) || 0;
            let tax = parseFloat($(this).find('.row-tax').val()) || 0;
            let qty = parseInt($(this).find('.row-qty').val()) || 0;

            let lineSubtotal = price * qty;
            let taxAmt = lineSubtotal * (tax / 100);

            itemsSubtotal += lineSubtotal;
            totalTax += taxAmt;
        });

        if (count > 0) {
            $('#empty-table-msg').addClass('hidden');
        } else {
            $('#empty-table-msg').removeClass('hidden');
        }
        $('#item-count-badge').text(count + ' Items');

        let vatPercent = parseFloat($('#vat_input').val()) || 0;
        let discountPercent = parseFloat($('#discount_input').val()) || 0;
        let paidAmt = parseFloat($('#payment_input').val()) || 0;

        let rawTotal = itemsSubtotal + totalTax;
        let vatAmount = rawTotal * (vatPercent / 100);
        let discountAmount = rawTotal * (discountPercent / 100);

        let grandTotal = rawTotal + vatAmount - discountAmount;
        let dueAmount = grandTotal - paidAmt;

        $('#summary_subtotal').text(itemsSubtotal.toFixed(2));
        $('#summary_tax').text(totalTax.toFixed(2));
        $('#summary_vat').text(vatAmount.toFixed(2));
        $('#summary_discount').text(discountAmount.toFixed(2));
        $('#summary_grand_total').text(grandTotal.toFixed(2));
        $('#summary_due').text(dueAmount.toFixed(2));
    }

    // 6. FORM SUBMIT VALIDATION
    $('#purchase-form').on('submit', function(e) {
        if ($('.item-row').length === 0) {
            e.preventDefault();
            alert('Please select and add at least one product to the purchase list!');
            return false;
        }
    });
});
</script>
@endsection