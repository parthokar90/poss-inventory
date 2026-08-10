@extends('admin.layouts.master')

@section('title', 'Dashboard | Add Brand')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- Breadcrumb & Title Section -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">Add New Brand</h1>
            <p class="text-sm text-gray-500">Fill in the brand details below to register a brand.</p>
        </div>
        <a href="{{ route('brand.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to List
        </a>
    </div>

    <!-- Create Card Form -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-semibold text-gray-700">Brand Information</h2>
        </div>

        <form action="{{ route('brand.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Brand Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Brand Name <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       id="name"
                       name="name" 
                       autocomplete="off" 
                       value="{{ old('name') }}"
                       placeholder="e.g., Nike, Adidas"
                       class="w-full px-4 py-2.5 border @error('name') border-rose-500 @else border-gray-300 @enderror rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                @error('name')
                    <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Brand Logo Upload -->
            <div>
                <label for="brand_logo" class="block text-sm font-medium text-gray-700 mb-1">
                    Brand Logo
                </label>
                <input type="file" 
                       id="brand_logo"
                       name="brand_logo" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer border border-gray-300 rounded-lg">
            </div>

            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea id="description"
                          name="description" 
                          rows="4" 
                          maxlength="100" 
                          placeholder="Short description of the brand (max 100 characters)..."
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition resize-none">{{ old('description') }}</textarea>
            </div>

            <!-- Form Submit Action -->
            <div class="pt-4 border-t border-gray-100 flex justify-end">
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-sm transition">
                    Save Brand
                </button>
            </div>
        </form>
    </div>
</div>
@endsection