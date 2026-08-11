@extends('admin.layouts.master')

@section('title', 'Dashboard | Add Category')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Category</h2>
    </div>

    <!-- Main Card Content -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Create Category Information</h2>
            
            <a href="{{ route('category.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                Category List
            </a>
        </div>

        <div class="p-6">
            <form action="{{ route('category.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <!-- Category Name Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="category_name" 
                           autocomplete="off" 
                           value="{{ old('category_name') }}"
                           class="w-full px-4 py-2 border @error('category_name') border-red-500 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('category_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parent Category Select Box -->
                @if($list->count() > 0)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Parent Category</label>
                    <select name="parent_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="0">Choose Parent</option>
                        @foreach($list as $item)
                            <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <!-- Image Upload Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                    <input type="file" 
                           name="image" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                </div>

                <!-- Description Textarea -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" 
                              rows="4" 
                              maxlength="100" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none">{{ old('description') }}</textarea>
                </div>

                <!-- Form Submit Button -->
                <div>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors duration-200">
                        SAVE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection