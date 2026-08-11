@extends('admin.layouts.master')

@section('title', 'Dashboard | Edit Category')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Category</h2>
    </div>

    <!-- Main Card Content -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Edit Category Information</h2>
            
            <div class="flex space-x-2">
                <a href="{{ route('category.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                    List
                </a>
                <a href="{{ route('category.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                    Add
                </a>
            </div>
        </div>

        <div class="p-6">
            <form action="{{ route('category.update', $edit->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')

                <!-- Category Name Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Name <span class="text-red-500">*</span></label>
                    <input type="text" 
                           name="category_name" 
                           autocomplete="off" 
                           value="{{ $edit->category_name }}"
                           class="w-full px-4 py-2 border @error('category_name') border-red-500 @else border-gray-300 @enderror rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('category_name')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Parent Category Select Box -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Parent Category</label>
                    <select name="parent_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="0">Select Parent</option>
                        @foreach ($list as $item)
                            <option value="{{ $item->id }}" {{ ($item->id == $edit->parent_id) ? 'selected' : '' }}>
                                {{ $item->category_name }}
                            </option>
                        @endforeach    
                    </select>
                </div>

                <!-- Image Upload Input & Current Preview -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category Image</label>
                    <div class="flex items-center space-x-4 mb-2">
                        <!-- Preview Image with fallback placeholder -->
                        <img width="50" height="50" 
                             src="{{ !empty($edit->image) ? asset('category_logo/'.$edit->image) : 'https://via.placeholder.com/50x50?text=No+Image' }}" 
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/50x50?text=No+Image';" 
                             alt="Category Preview" 
                             class="w-12 h-12 object-cover rounded-lg border border-gray-200">
                    </div>
                    <input type="file" 
                           name="image" 
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 border border-gray-300 rounded-lg cursor-pointer focus:outline-none">
                    <input type="hidden" name="d_logo" value="{{ $edit->image }}">
                </div>

                <!-- Description Textarea -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea name="description" 
                              rows="4" 
                              maxlength="100" 
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent resize-none">{{ $edit->description }}</textarea>
                </div>

                <!-- Status Dropdown -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="1" {{ $edit->status == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $edit->status == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium text-sm rounded-lg shadow-sm transition-colors duration-200">
                        UPDATE
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection