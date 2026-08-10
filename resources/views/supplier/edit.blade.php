@extends('admin.layouts.master')
@section('title') Dashboard | Edit Supplier @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Page Header --}}
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 uppercase tracking-wider">Supplier</h2>
    </div>

    <div class="w-full">
        <div class="bg-white rounded-lg shadow-md border border-gray-100 overflow-hidden">
            
            {{-- Card Header --}}
            <div class="p-5 border-b border-gray-100 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-gray-700 uppercase">Edit Supplier Information</h2>
                
                {{-- Header Dropdown Menu --}}
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full focus:outline-none">
                        <i class="material-icons">more_vert</i>
                    </button>
                    
                    {{-- Fixed route bug: Updated office to supplier routes --}}
                    <div x-show="open" 
                         @click.away="open = false" 
                         class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-10"
                         style="display: none;">
                        <a href="{{ route('supplier.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Supplier List</a>
                        <a href="{{ route('supplier.create') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Add Supplier</a>
                    </div>
                </div>
            </div>

            {{-- Form Body --}}
            <div class="p-6">
                <form action="{{ route('supplier.update', $edit->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf 
                    @method('PATCH')

                    {{-- Supplier Name Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Supplier Name <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="supplier_name" 
                               autocomplete="off" 
                               value="{{ $edit->supplier_name }}"
                               class="w-full px-4 py-2 text-sm bg-gray-50 border @error('supplier_name') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        @error('supplier_name')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-rose-500">*</span></label>
                        <input type="email" 
                               name="supplier_email" 
                               autocomplete="off" 
                               value="{{ $edit->supplier_email }}"
                               class="w-full px-4 py-2 text-sm bg-gray-50 border @error('supplier_email') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        @error('supplier_email')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Phone Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Phone <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="supplier_phone" 
                               autocomplete="off" 
                               value="{{ $edit->supplier_phone }}"
                               class="w-full px-4 py-2 text-sm bg-gray-50 border @error('supplier_phone') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        @error('supplier_phone')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Country Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Country <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="country" 
                               autocomplete="off" 
                               value="{{ $edit->country }}"
                               class="w-full px-4 py-2 text-sm bg-gray-50 border @error('country') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        @error('country')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- City Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">City <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="city" 
                               autocomplete="off" 
                               value="{{ $edit->city }}"
                               class="w-full px-4 py-2 text-sm bg-gray-50 border @error('city') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        @error('city')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- State Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">State <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="state" 
                               autocomplete="off" 
                               value="{{ $edit->state }}"
                               class="w-full px-4 py-2 text-sm bg-gray-50 border @error('state') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        @error('state')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Postcode Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Post Code <span class="text-rose-500">*</span></label>
                        <input type="text" 
                               name="postcode" 
                               autocomplete="off" 
                               value="{{ $edit->postcode }}"
                               class="w-full px-4 py-2 text-sm bg-gray-50 border @error('postcode') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                        @error('postcode')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address Textarea Field --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Address <span class="text-rose-500">*</span></label>
                        <textarea name="supplier_address" 
                                  rows="4" 
                                  maxlength="100" 
                                  class="w-full px-4 py-2 text-sm bg-gray-50 border @error('supplier_address') border-rose-500 @else border-gray-300 @enderror rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none transition-colors">{{ $edit->supplier_address }}</textarea>
                        @error('supplier_address')
                            <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status Dropdown Select --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status" class="w-full px-4 py-2 text-sm bg-gray-50 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition-colors">
                            <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Submit Button --}}
                    <div class="pt-3">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors uppercase tracking-wider focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            UPDATE
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection