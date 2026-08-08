@extends('admin.layouts.master')

@section('title') Dashboard | Add Product @endsection

@section('content')
<div class="w-full px-4 py-6 mx-auto">
    @include('admin.includes.messages')
    
    {{-- Page Title --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold tracking-tight text-gray-800 uppercase">Product</h1>
    </div>

    {{-- Main Card --}}
    <div class="bg-white rounded-lg border border-gray-200 shadow-sm overflow-hidden">
        {{-- Card Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h2 class="text-md font-semibold text-gray-800 uppercase">Create Product Information</h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('product.index') }}" class="px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 transition">List</a>
                <a href="{{ route('product.create') }}" class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 rounded-md shadow-sm hover:bg-blue-700 transition">Add</a>
            </div>
        </div>

        {{-- Form Body --}}
        <div class="p-6">
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Form Grid Container --}}
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">

                    {{-- Product Type --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Type</label>
                        <select name="product_type" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Standard" {{ old('product_type') == 'Standard' ? 'selected' : '' }}>Standard</option>
                            <option value="Combo" {{ old('product_type') == 'Combo' ? 'selected' : '' }}>Combo</option>
                            <option value="Digital" {{ old('product_type') == 'Digital' ? 'selected' : '' }}>Digital</option>
                            <option value="Service" {{ old('product_type') == 'Service' ? 'selected' : '' }}>Service</option>
                        </select>
                    </div>

                    {{-- Product Name --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="product_name" value="{{ old('product_name') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('product_name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Cost --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cost <span class="text-red-500">*</span></label>
                        <input type="number" step="any" min="0" name="product_cost" value="{{ old('product_cost') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('product_cost')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Price --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price <span class="text-red-500">*</span></label>
                        <input type="number" step="any" min="0" name="product_price" value="{{ old('product_price') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('product_price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alert Quantity --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alert Quantity <span class="text-red-500">*</span></label>
                        <input type="number" min="0" name="product_alert_qty" value="{{ old('product_alert_qty') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('product_alert_qty')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Weight --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                        <input type="text" name="product_weight" value="{{ old('product_weight') }}" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    {{-- Image --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                        <input type="file" name="product_image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-xs file:font-medium file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 cursor-pointer">
                        @error('product_image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Brand --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Brand <span class="text-red-500">*</span></label>
                        <select name="product_brand" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Select Brand --</option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('product_brand') == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach  
                        </select>
                        @error('product_brand')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Category --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Category <span class="text-red-500">*</span></label>
                        <select name="product_cat_id" id="cat_id" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Select Category --</option>
                            @foreach($categorys as $category)
                                <option value="{{ $category->id }}" {{ old('product_cat_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach  
                        </select>
                        @error('product_cat_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Sub Category --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sub Category</label>
                        <select id="sub" name="product_subcat_id" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>

                    {{-- Unit --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Unit</label>
                        <select name="product_unit_id" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Select Unit --</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('product_unit_id') == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->unit_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tax Rate --}}
                    <div class="col-span-12 md:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Tax Rate</label>
                        <select name="tax_rate_id" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Select Tax --</option>
                            @foreach($taxrates as $taxrate)
                                <option value="{{ $taxrate->id }}" {{ old('tax_rate_id') == $taxrate->id ? 'selected' : '' }}>
                                    {{ $taxrate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Details --}}
                    <div class="col-span-12 md:col-span-9">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Details</label>
                        <textarea name="product_details" rows="3" maxlength="255" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none">{{ old('product_details') }}</textarea>
                    </div>

                    {{-- Default Warehouse (Single Product Mode) --}}
                    <div class="col-span-12 md:col-span-6" id="were_id">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Warehouse <span class="text-red-500">*</span></label>
                        <select name="warehouse_id" id="warehouse_id" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @foreach($warehouse as $items) 
                                <option value="{{ $items->id }}">{{ $items->name }}</option>
                            @endforeach 
                        </select>
                    </div>

                    {{-- Variant Checkbox --}}
                    <div class="col-span-12 flex items-center space-x-2 my-2">
                        <input type="checkbox" id="product_varient_div_show" name="v_check" class="h-4 w-4 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                        <label for="product_varient_div_show" class="text-sm font-medium text-gray-700 select-none">This product has multiple variants</label>
                        @error('varient_id')
                            <p class="text-red-500 text-xs ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Variant Selection Dropdown --}}
                    <div class="col-span-12 md:col-span-4" id="product_varient" style="display: none;">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Variant</label>
                        <select id="product_variants" class="w-full px-3 py-2 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Choose Variant --</option>
                            @foreach($variants as $v)
                                <option data-name="{{ $v->varient_name }}" value="{{ $v->id }}">{{ $v->varient_name }}</option>
                            @endforeach   
                        </select>
                    </div>

                    {{-- Dynamic Variant Table Wrapper --}}
                    <div class="col-span-12" id="varient_table_wrapper" style="display:none;">
                        <div class="overflow-x-auto border border-gray-200 rounded-lg">
                            <table id="tbUser" class="min-w-full divide-y divide-gray-200 text-left text-sm">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Variant Name</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Warehouse</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Quantity</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Rack</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs">Price Addition</th>
                                        <th class="px-4 py-3 font-semibold text-gray-600 uppercase tracking-wider text-xs text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="variant_table_body" class="bg-white divide-y divide-gray-200">
                                    {{-- Dynamic rows injected here --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                {{-- Submit Button --}}
                <div class="mt-6">
                    <button id="save_btn" type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium text-sm rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150">SAVE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Toggle Variants dropdown vs Single Warehouse select
        $("#product_varient_div_show").change(function() {  
            if ($(this).is(":checked")) { 
                $("#product_varient").show();
                $("#were_id").hide();
            } else { 
                $("#product_varient").hide();
                $("#varient_table_wrapper").hide();
                $("#variant_table_body").empty();
                $("#product_variants").val('');
                $("#were_id").show();
            } 
        });

        // Add Variant Row to Dynamic Table
        $("#product_variants").change(function() {
            var attribute_id = $(this).val();
            if (!attribute_id) return;

            var attribute_name = $('option:selected', this).data('name');

            // Check if variant is already added
            var exists = false;
            $("input[name='varient_id[]']").each(function() {
                if ($(this).val() == attribute_id) {
                    exists = true;
                    return false; // Break loop
                }
            });

            if (exists) {
                alert('This variant has already been added.');
                $(this).val('');
                return;
            }

            // Generate HTML options for warehouse dropdown
            var warehouseOptions = "@foreach($warehouse as $items)<option value='{{ $items->id }}'>{{ $items->name }}</option>@endforeach";

            // Append Row to dynamic table with Tailwind CSS
            var row = `
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 whitespace-nowrap text-gray-800">
                        <input type="hidden" name="varient_id[]" value="${attribute_id}"> 
                        <span class="font-semibold">${attribute_name}</span>
                    </td>
                    <td class="px-4 py-3">
                        <select name="variant_warehouse_id[]" class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                            ${warehouseOptions}
                        </select>
                    </td> 
                    <td class="px-4 py-3">
                        <input type="number" name="variant_qty[]" value="1" min="1" class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </td> 
                    <td class="px-4 py-3">
                        <input type="text" name="variant_rack[]" value="No Rack" class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </td> 
                    <td class="px-4 py-3">
                        <input type="number" step="any" min="0" name="price_addition[]" value="0" placeholder="Enter Price" class="w-full px-2 py-1 text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
                    </td>
                    <td class="px-4 py-3 text-center">
                        <button type="button" class="btn_delete px-2.5 py-1 text-xs font-semibold text-white bg-red-600 hover:bg-red-700 rounded-md shadow-sm transition">
                            Remove
                        </button>
                    </td>
                </tr>`;

            $("#variant_table_body").append(row);
            $("#varient_table_wrapper").show();
            
            // Reset dropdown select back to default
            $(this).val('');
        });

        // Delete Variant Row via Event Delegation
        $("#variant_table_body").on("click", ".btn_delete", function(e) {
            e.preventDefault();
            $(this).closest("tr").remove();

            if ($("#variant_table_body tr").length === 0) {
                $("#varient_table_wrapper").hide();
            }
        });

        // Dynamic Sub-Category AJAX Request
        $("#cat_id").change(function() {
            var id = $(this).val();
            if (!id) {
                $("#sub").html("<option value=''>Select Sub Category</option>");
                return;
            }

            $.ajax({
                url: "{{ url('/sub-category') }}/" + id,
                type: "GET",
                dataType: "json",
                success: function(response) {
                    var items = "<option value=''>Select Sub Category</option>";
                    $.each(response, function(i, item) {
                        items += `<option value="${item.id}">${item.category_name}</option>`;
                    });
                    $("#sub").html(items);
                },
                error: function(xhr) {
                    console.error("Failed to fetch subcategories", xhr);
                }
            });
        });
    });
</script>
@endsection