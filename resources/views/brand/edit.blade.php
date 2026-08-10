@extends('admin.layouts.master')

@section('title', 'Dashboard | Edit Brand')

@section('content')
<div class="container mx-auto px-4 py-6 max-w-4xl">
    <!-- Header Section -->
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-tight">Edit Brand</h1>
            <p class="text-sm text-gray-500">Update current brand profile and visibility settings.</p>
        </div>
        <a href="{{ route('brand.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-600 hover:text-gray-900 font-medium">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to List
        </a>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h2 class="text-lg font-semibold text-gray-700">Modify Brand Details</h2>
        </div>

        <form action="{{ route('brand.update', $edit->id) }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            @method('PATCH')

            <!-- Brand Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Brand Name <span class="text-rose-500">*</span>
                </label>
                <input type="text" 
                       id="name"
                       name="name" 
                       autocomplete="off" 
                       value="{{ old('name', $edit->name) }}"
                       class="w-full px-4 py-2.5 border @error('name') border-rose-500 @else border-gray-300 @enderror rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                @error('name')
                    <p class="mt-1 text-xs text-rose-500 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <!-- Existing Image & File Input -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Brand Logo
                </label>
                <div class="flex items-center gap-4 mb-3">
                    @if($edit->image)
                        <img class="w-20 h-12 object-cover rounded-md border border-gray-200 shadow-sm" 
                             src="{{ asset('brand_logo/'.$edit->image) }}" 
                             alt="Current Logo">
                    @else
                        <span class="text-xs text-gray-400 italic">No image stored</span>
                    @endif
                </div>
                <input type="file" 
                       name="brand_logo" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition cursor-pointer border border-gray-300 rounded-lg">
                
                {{-- Hidden Input for default file preservation --}}
                <input type="hidden" name="d_logo" value="{{ $edit->image }}">
            </div>

            <!-- Description Input -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea id="description"
                          name="description" 
                          rows="4" 
                          maxlength="100" 
                          class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition resize-none">{{ old('description', $edit->description) }}</textarea>
            </div>

            <!-- Status Dropdown Select -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select id="status" 
                        name="status" 
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition bg-white">
                    <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <!-- Action Controls -->
            <div class="pt-4 border-t border-gray-100 flex justify-end gap-3">
                <a href="{{ route('brand.index') }}" class="px-5 py-2.5 rounded-lg text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 transition">
                    Cancel
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-lg shadow-sm transition">
                    Update Brand
                </button>
            </div>
        </form>
    </div>
</div>
@endsection