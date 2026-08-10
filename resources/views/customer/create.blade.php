@extends('admin.layouts.master')

@section('title') Dashboard | Add Customer @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Customer</h2>
    </div>

    <!-- Form Container -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header & Action Links -->
        <div class="p-5 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Create Customer Information</h2>
            <div class="flex space-x-2">
                <a href="{{ route('customer.index') }}" class="px-3 py-1.5 bg-gray-600 text-white text-xs font-medium rounded hover:bg-gray-700 transition">List</a>
                <a href="{{ route('customer.create') }}" class="px-3 py-1.5 bg-indigo-600 text-white text-xs font-medium rounded hover:bg-indigo-700 transition">Add</a>
            </div>
        </div>

        <!-- Form Body -->
        <div class="p-6">
            <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf 

                <!-- Customer Name Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Customer Name *</label>
                    <input 
                        type="text" 
                        name="customer_name" 
                        autocomplete="off" 
                        value="{{ old('customer_name') }}"
                        class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('customer_name') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('customer_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input 
                        type="email" 
                        name="customer_email" 
                        autocomplete="off" 
                        value="{{ old('customer_email') }}"
                        class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('customer_email') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('customer_email')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone *</label>
                    <input 
                        type="text" 
                        name="customer_phone" 
                        autocomplete="off" 
                        value="{{ old('customer_phone') }}"
                        class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('customer_phone') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('customer_phone')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Country Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                    <input 
                        type="text" 
                        name="country" 
                        autocomplete="off" 
                        value="{{ old('country') }}"
                        class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('country') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('country')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- City Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">City *</label>
                    <input 
                        type="text" 
                        name="city" 
                        autocomplete="off" 
                        value="{{ old('city') }}"
                        class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('city') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('city')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- State Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">State *</label>
                    <input 
                        type="text" 
                        name="state" 
                        autocomplete="off" 
                        value="{{ old('state') }}"
                        class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('state') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('state')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Post Code Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Post Code *</label>
                    <input 
                        type="text" 
                        name="postcode" 
                        autocomplete="off" 
                        value="{{ old('postcode') }}"
                        class="w-full px-3 py-2 border rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('postcode') border-red-500 @else border-gray-300 @enderror"
                    >
                    @error('postcode')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Address Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Address *</label>
                    <textarea 
                        name="customer_address" 
                        rows="4" 
                        maxlength="100" 
                        class="w-full px-3 py-2 border rounded-md text-sm resize-none focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('customer_address') border-red-500 @else border-gray-300 @enderror"
                    >{{ old('customer_address') }}</textarea>
                    @error('customer_address')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="pt-2">
                    <button 
                        type="submit" 
                        class="px-5 py-2 bg-indigo-600 text-white font-medium text-sm rounded-md shadow hover:bg-indigo-700 transition duration-150 uppercase"
                    >
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection