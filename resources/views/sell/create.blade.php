@extends('admin.layouts.master')
@section('title') Dashboard | Add Sell @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    @include('admin.includes.messages')

    <div class="w-full">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <!-- Header Section -->
            <div class="flex justify-between items-center px-6 py-4 bg-gray-50/50 border-b border-gray-100">
                <div>
                    <h2 class="text-xl font-bold text-gray-800">POS Terminal</h2>
                    <p class="text-xs text-gray-500">Quick checkout system</p>
                </div>
                
                <!-- Action Dropdown -->
                <div class="relative group">
                    <button type="button" class="text-gray-400 hover:text-gray-600 focus:outline-none p-2 rounded-lg hover:bg-white hover:shadow-sm border border-transparent hover:border-gray-200 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4zm0 6a2 2 0 110-4 2 2 0 010 4z"/>
                        </svg>
                    </button>
                    <div class="hidden group-hover:block absolute right-0 w-48 bg-white rounded-lg shadow-xl border border-gray-100 py-1 z-50">
                        <a href="{{route('sales.index')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">Sales List</a>
                        <a href="{{route('sales.create')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">New Sale</a>
                    </div>
                </div>
            </div>

            <!-- Body Section -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">

                    <!-- POS Form Section (5 Columns) -->
                    <div class="lg:col-span-5 border-r border-gray-100 pr-0 lg:pr-8 space-y-4">
                        <form method="post" action="{{route('sales.store')}}" class="space-y-4">
                            @csrf 

                            <!-- Customer & Warehouse -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label for="customer_id" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Customer</label>
                                    <select id="customer_id" name="customer_id" class="w-full text-sm border-gray-200 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        @foreach($customer as $customers)
                                            <option value="{{$customers->id}}">({{$customers->customer_phone}})-{{$customers->customer_name}}</option>
                                        @endforeach   
                                    </select>
                                </div>

                                <div>
                                    <label for="warehouse_id" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Warehouse</label>
                                    <select id="warehouse_id" name="warehouse_id" class="w-full text-sm border-gray-200 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                        <option value="">Select Warehouse</option>
                                        @foreach($warehouse as $warehouses)
                                            <option value="{{$warehouses->id}}">({{$warehouses->name}})</option>
                                        @endforeach   
                                    </select>
                                </div>
                            </div>

                            <!-- Product Scanner Dropdown -->
                            <div>
                                <label for="product_id" class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Scan Code / Direct Select</label>
                                <select id="product_id" name="product_id" class="w-full text-sm border-gray-200 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Scan or select product...</option>
                                    @foreach($product as $item)
                                        <option value="{{$item->id}}">({{$item->product_code}}) {{$item->product_name}}</option>
                                    @endforeach 
                                </select>
                            </div>

                            <!-- Cart Items Table Container -->
                            <div class="border border-gray-200 rounded-lg overflow-hidden bg-white shadow-sm">
                                <div class="max-h-[260px] overflow-y-auto">
                                    <table class="min-w-full divide-y divide-gray-200 text-left" id="productTable">
                                        <thead class="bg-gray-50 sticky top-0 z-10">
                                            <tr>
                                                <th class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Product</th>
                                                <th class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Price</th>
                                                <th class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Qty</th>
                                                <th class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase">Subtotal</th>
                                                <th class="px-3 py-2 text-xs font-semibold text-gray-500 uppercase text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 bg-white">
                                            <!-- Dynamic cart rows will render here -->
                                            <tr id="emptyCartRow">
                                                <td colspan="5" class="px-3 py-8 text-center text-xs text-gray-400">
                                                    No products added to cart yet
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Calculation Summary -->
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-100 space-y-3">
                                <div class="flex justify-between items-center text-xs font-medium text-gray-600 border-b border-gray-200 pb-2">
                                    <span>Total Items: <strong id="count" class="text-gray-900 font-bold">0</strong></span>
                                    <span>Subtotal: <strong id="total" class="text-gray-900 font-bold">0.00</strong></span>
                                    <input type="hidden" id="order_total" value="">
                                </div>

                                <div class="grid grid-cols-2 gap-3">
                                    <div>
                                        <label for="tax" class="block text-xs text-gray-500 mb-1">Tax (%)</label>
                                        <input value="0" min="0" type="number" id="tax" name="tax" autocomplete="off" class="w-full border-gray-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    <div>
                                        <label for="discount" class="block text-xs text-gray-500 mb-1">Discount (%)</label>
                                        <input value="0" min="0" type="number" id="discount" name="discount" autocomplete="off" class="w-full border-gray-200 rounded-lg text-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                </div>

                                <div class="bg-indigo-900 text-white flex justify-between items-center px-4 py-3 rounded-lg shadow-sm">
                                    <span class="text-xs uppercase tracking-wider font-medium">Total Payable</span>
                                    <span id="gtotal" class="text-xl font-extrabold">0.00</span>
                                </div>
                            </div>

                            <!-- Order Meta Options -->
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Sale Date</label>
                                    <input type="date" class="w-full text-sm border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" name="sale_date" value="{{ date('Y-m-d') }}">
                                </div>
                                <div>
                                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Payment Method</label>
                                    <select class="w-full text-sm border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" name="payment_method">
                                        <option value="Cash">Cash</option>
                                        <option value="bKash">bKash</option>
                                        <option value="visa">Visa</option>
                                        <option value="master">Master</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Sale Note</label>
                                <textarea class="w-full text-sm border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" name="sale_note" rows="2" placeholder="Add optional note..."></textarea>
                            </div>

                            <div>
                                <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1">Payment Received</label>
                                <input type="number" step="0.01" class="w-full text-sm border-gray-200 rounded-lg focus:border-indigo-500 focus:ring-indigo-500" min="0" name="total_payment" placeholder="0.00">
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg shadow-sm hover:shadow transition-all duration-150 flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Complete Sale</span>
                            </button>
                        </form>
                    </div>

                    <!-- Product Grid Section (7 Columns) -->
                    <div class="lg:col-span-7 space-y-4">
                        <!-- Quick Search Filter Bar -->
                        <div class="relative">
                            <input type="text" id="product_search_input" placeholder="Search products by name..." class="w-full text-sm pl-10 pr-4 py-2 border-gray-200 rounded-lg shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <svg class="w-4 h-4 text-gray-400 absolute left-3.5 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>

                        <!-- Product Cards Container (Fixed Height + Smooth Internal Scroll) -->
                        <div class="max-h-[620px] overflow-y-auto pr-1">
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3" id="productGrid">
                                @foreach($product as $item)
                                    <div class="bg-white border border-gray-100 rounded-xl shadow-xs hover:shadow-md hover:border-indigo-300 cursor-pointer transition-all duration-150 product_item overflow-hidden flex flex-col justify-between group" 
                                         id="{{$item->id}}" 
                                         data-name="{{ strtolower($item->product_name) }}">
                                        
                                        <!-- Product Image + Fallback Placeholder -->
                                        <div class="w-full h-28 bg-gray-50 flex items-center justify-center overflow-hidden relative">
                                            <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-200" 
                                                 src="{{asset('product_image/'.$item->product_image)}}" 
                                                 alt="{{$item->product_name}}"
                                                 onerror="this.onerror=null; this.src='data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' fill=\'none\' viewBox=\'0 0 24 24\' stroke=\'%23a1a1aa\' class=\'w-8 h-8\'><path stroke-linecap=\'round\' stroke-linejoin=\'round\' stroke-width=\'1.5\' d=\'M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z\'/></svg>';">
                                        </div>
                                        
                                        <div class="p-2.5 text-center bg-white flex-1 flex flex-col justify-between">
                                            <h5 class="text-xs font-semibold text-gray-700 line-clamp-2 leading-snug">{{$item->product_name}}</h5>
                                            <span class="text-xs font-bold text-indigo-600 mt-1 block">Tk {{$item->price ?? '0'}}</span>
                                        </div>
                                    </div>  
                                @endforeach 
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript Dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $("#product_id").select2();
        $("#customer_id").select2();
        $("#warehouse_id").select2();
        
        // Initial Cart Load
        getItem();
    });

    // Client-side quick filter for products grid
    $("#product_search_input").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#productGrid .product_item").filter(function() {
            $(this).toggle($(this).data('name').indexOf(value) > -1)
        });
    });

    function renderCartTable(response) {
        if (!response || response.length === 0) {
            $("#productTable").html("<tbody class='divide-y divide-gray-100 bg-white'><tr><td colspan='5' class='px-3 py-8 text-center text-xs text-gray-400'>No products added to cart yet</td></tr></tbody>");
            return;
        }

        var items = "<thead class='bg-gray-50 sticky top-0 z-10'><tr><th class='px-3 py-2 text-xs font-semibold text-gray-500 uppercase'>Product</th><th class='px-3 py-2 text-xs font-semibold text-gray-500 uppercase'>Price</th><th class='px-3 py-2 text-xs font-semibold text-gray-500 uppercase'>Qty</th><th class='px-3 py-2 text-xs font-semibold text-gray-500 uppercase'>Subtotal</th><th class='px-3 py-2 text-xs font-semibold text-gray-500 uppercase text-center'>Action</th></tr></thead><tbody class='divide-y divide-gray-100 bg-white'>"; 
        
        $.each(response, function(i, item) {
            var remove_id = item.id;  
            items += "<tr>" +
                "<td class='px-3 py-2 text-xs text-gray-800 font-medium'>" + item.product_name + "</td>" +
                "<td class='px-3 py-2 text-xs text-gray-600'>" + item.price + "</td>" +
                "<td class='px-3 py-2 text-xs text-gray-600'><input onchange='update(\"" + remove_id + "\", this.value)' type='number' min='1' class='w-14 border-gray-200 rounded text-xs p-1 focus:ring-indigo-500' value='" + item.quantity + "' autocomplete='off'></td>" +
                "<td class='px-3 py-2 text-xs text-gray-800 font-semibold'>" + item.sub_total + "</td>" +
                "<td class='px-3 py-2 text-xs text-center'><button type='button' class='text-red-500 hover:text-red-700 font-bold px-2 py-1 rounded hover:bg-red-50 transition' onclick='remove(\"" + remove_id + "\")'>✕</button></td>" +
                "</tr>";
        });  
        items += "</tbody>";
        $("#productTable").html(items);
    }

    function getItem() {
        $.ajax({
            url: "{{url('/ajax/item/all')}}",
            type: "GET",
            success: function(response) {
                total_item();
                total_price();
                renderCartTable(response);
            }
        });
    }

    $('.product_item').click(function() {
        var id = $(this).attr("id");
        $.ajax({
            url: "{{url('/product/ajax/')}}" + '/' + id,
            type: "GET",
            success: function(response) {
                renderCartTable(response);
                total_item();
                total_price();
                grandTotal();
            }
        });
    });

    $("#product_id").change(function() {
        var id = $("#product_id").val();
        if(!id) return;
        $.ajax({
            url: "{{url('/product/ajax/')}}" + '/' + id,
            type: "GET",
            success: function(response) {
                renderCartTable(response);
                total_item();
                total_price();
                grandTotal();
            }
        });
    });

    function total_item() {
        $.ajax({
            url: "{{url('/ajax/item')}}",
            type: "GET",
            success: function(response) {
                document.getElementById('count').innerHTML = response;
            }
        });
    }

    function total_price() {
        $.ajax({
            url: "{{url('/ajax/total')}}",
            type: "GET",
            success: function(response) {
                document.getElementById('total').innerHTML = response;
                document.getElementById('order_total').value = response;
            }
        });
    }

    function grandTotal() {
        $.ajax({
            url: "{{url('/ajax/grandTotal/')}}",
            type: "GET",
            success: function(response) {
                document.getElementById('gtotal').innerHTML = response;
            }
        });
    }

    function update(id, value) {
        if(value <= 0) return;
        $.ajax({
            url: "{{url('/ajax/item/update/')}}" + "/" + id + "/" + value,
            type: "GET",
            success: function(response) {
                getItem(); 
                total_item();
                total_price();
                grandTotal();
            }
        });
    }

    function remove(id) {
        $.ajax({
            url: "{{url('/ajax/item/remove/')}}" + "/" + id,
            type: "GET",
            success: function(response) {
                getItem();
                total_item();
                total_price();
                grandTotal();
            }
        });
    }

    $("#tax, #discount").on('keyup change', function() {
        var tax = $("#tax").val() || 0; 
        var discount = $("#discount").val() || 0; 

        $.ajax({
            url: "{{url('/ajax/tax/')}}" + "/" + tax,
            type: "GET",
            success: function() {
                $.ajax({
                    url: "{{url('/ajax/discount/')}}" + "/" + discount,
                    type: "GET",
                    success: function() {
                        grandTotal();
                    }
                });
            }
        });
    });

    $("#warehouse_id").change(function() {
        var id = $("#warehouse_id").val();
        $.ajax({
            url: "{{url('/warehouse_product/')}}" + '/' + id,
            type: "GET",
            success: function(response) {
                var items = "<option value=''>Select Product</option>"; 
                $.each(response, function(i, item) {
                    items += "<option value='" + item.id + "'>" + item.product_name + "</option>";
                });
                $("#product_id").html(items);
            }
        });
    });
</script>
@endsection