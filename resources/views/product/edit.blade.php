@extends('admin.layouts.master')

@section('title') Dashboard | Edit Product @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-xs font-semibold uppercase tracking-wider text-gray-500">Product</h2>
            <h1 class="text-2xl font-bold text-gray-800">Edit Product Information</h1>
        </div>
        
        <!-- Dropdown Menu -->
        <div class="relative inline-block text-left" x-data="{ open: false }">
            <button @click="open = !open" type="button" class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="material-icons">more_vert</i>
            </button>
            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 z-10 py-1" style="display: none;">
                <a href="{{ route('product.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">List</a>
                <a href="{{ route('product.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Add</a>
            </div>
        </div>
    </div>

    <!-- Main Card Form -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-100">
        <div class="p-6">
            <form action="{{ route('product.update', $edit->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    {{-- Product Type --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Type</label>
                        <select name="product_type" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @foreach(['Standard', 'Combo', 'Digital', 'Service'] as $type)
                                <option value="{{ $type }}" {{ $edit->product_type == $type ? 'selected' : '' }}>
                                    {{ $type }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Product Name --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name <span class="text-red-500">*</span></label>
                        <input type="text" name="product_name" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('product_name', $edit->product_name) }}">
                        @if($errors->has('product_name'))
                            <p class="mt-1 text-xs text-red-600">{{ $errors->first('product_name') }}</p>
                        @endif
                    </div>

                    {{-- Cost --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Cost <span class="text-red-500">*</span></label>
                        <input type="text" name="product_cost" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('product_cost', $edit->product_cost) }}">
                        @if($errors->has('product_cost'))
                            <p class="mt-1 text-xs text-red-600">{{ $errors->first('product_cost') }}</p>
                        @endif
                    </div>

                    {{-- Price --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Price <span class="text-red-500">*</span></label>
                        <input type="text" name="product_price" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('product_price', $edit->product_price) }}">
                        @if($errors->has('product_price'))
                            <p class="mt-1 text-xs text-red-600">{{ $errors->first('product_price') }}</p>
                        @endif
                    </div>

                    {{-- Alert Quantity --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alert Quantity <span class="text-red-500">*</span></label>
                        <input type="text" name="product_alert_qty" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('product_alert_qty', $edit->product_alert_qty) }}">
                        @if($errors->has('product_alert_qty'))
                            <p class="mt-1 text-xs text-red-600">{{ $errors->first('product_alert_qty') }}</p>
                        @endif
                    </div>

                    {{-- Weight --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Weight</label>
                        <input type="text" name="product_weight" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" value="{{ old('product_weight', $edit->product_weight) }}">
                    </div>

                    {{-- Image Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                        @if($edit->product_image)
                            <div class="mb-2">
                                <img class="w-24 h-12 object-cover rounded border border-gray-200" src="{{ asset('product_image/'.$edit->product_image) }}" alt="Product Image">
                            </div>
                        @endif
                        <input type="file" name="product_image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-md">
                        <input type="hidden" name="d_logo" value="{{ $edit->product_image }}">
                    </div>

                    {{-- Brand --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Brand <span class="text-red-500">*</span></label>
                        <select name="product_brand" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value=""></option>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->id }}" {{ old('product_brand', $edit->product_brand) == $brand->id ? 'selected' : '' }}>
                                    {{ $brand->name }}
                                </option>
                            @endforeach  
                        </select>
                        @if($errors->has('product_brand'))
                            <p class="mt-1 text-xs text-red-600">{{ $errors->first('product_brand') }}</p>
                        @endif
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Category <span class="text-red-500">*</span></label>
                        <select name="product_cat_id" id="cat_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value=""></option>
                            @foreach($categorys as $category)
                                <option value="{{ $category->id }}" {{ old('product_cat_id', $edit->product_cat_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach  
                        </select>
                        @if($errors->has('product_cat_id'))
                            <p class="mt-1 text-xs text-red-600">{{ $errors->first('product_cat_id') }}</p>
                        @endif
                    </div>

                    {{-- Sub Category --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Sub Category</label>
                        <select id="sub" name="product_subcat_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @if(isset($sub_category))
                                <option value="{{ $sub_category->id }}" selected>{{ $sub_category->category_name }}</option>
                            @endif
                        </select>
                    </div>

                    {{-- Unit --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Unit</label>
                        <select name="product_unit_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value=""></option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ old('product_unit_id', $edit->product_unit_id) == $unit->id ? 'selected' : '' }}>
                                    {{ $unit->unit_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tax Rate --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Select Tax Rate</label>
                        <select name="tax_rate_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option value=""></option>
                            @foreach($taxrates as $taxrate)
                                <option value="{{ $taxrate->id }}" {{ old('tax_rate_id', $edit->tax_rate_id) == $taxrate->id ? 'selected' : '' }}>
                                    {{ $taxrate->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Details (Spans 3 columns on large screens) --}}
                    <div class="col-span-1 md:col-span-2 lg:col-span-3">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Product Details</label>
                        <textarea name="product_details" rows="4" maxlength="100" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm resize-none">{{ old('product_details', $edit->product_details) }}</textarea>
                    </div>

                </div>

                <!-- Tables Section -->
                <div class="mt-8 space-y-6">
                    {{-- Warehouse Quantities (Non-variant Products) --}}
                    @if($item_varient->count() == 0)
                        <div>
                            <h3 class="text-md font-semibold text-gray-800 mb-3">Warehouse Quantity</h3>
                            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Warehouse</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rack</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($item_warehouse as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($item->Warehouses)->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" name="qty[]" min="0" value="{{ $item->qty }}" class="w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="text" name="racks[]" value="{{ $item->racks }}" class="w-full max-w-xs rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">   
                                                    <input type="hidden" name="warehouse_id[]" value="{{ $item->warehouse_id }}">
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif 
                        
                    {{-- Product Variants --}}
                    @if($item_varient->count() > 0)
                        <div>
                            <h3 class="text-md font-semibold text-gray-800 mb-3">Product Variant</h3>
                            <div class="overflow-x-auto border border-gray-200 rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Variant</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Warehouse</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Quantity</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rack</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price Addition</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($item_varient as $item)
                                            <tr class="hover:bg-gray-50">
                                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->Varient->varient_name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ optional($item->Warehouses)->name }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" name="qty[]" min="0" value="{{ $item->qty }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="text" name="racks[]" value="{{ $item->variant_rack }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="number" min="0" name="price_addition[]" value="{{ $item->price_addition }}" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                    <input type="hidden" name="varient_id[]" value="{{ $item->varient_id }}">
                                                    <input type="hidden" name="warehouse_ids[]" value="{{ $item->warehouse_id }}">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <select name="status[]" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                                                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach 
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif

                    <div id="varient_table" class="hidden"></div>
                </div>

                <!-- Submit Button -->
                <div class="mt-8">
                    <button id="save_btn" type="submit" class="inline-flex justify-center py-2 px-6 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-150">
                        UPDATE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
@endsection