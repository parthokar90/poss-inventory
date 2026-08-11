@extends('admin.layouts.master')

@section('title', 'Dashboard | Category')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Message Alerts -->
    @include('admin.includes.messages')

    <!-- Page Header -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 tracking-wide uppercase">Category</h2>
    </div>

    <!-- Main Card Content -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-100">
        <div class="p-6 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <h2 class="text-lg font-semibold text-gray-700 uppercase">Category Information</h2>
            
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('category.index') }}" class="flex items-center w-full sm:w-auto">
                    <div class="relative w-full">
                        <input type="text" 
                               class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent" 
                               name="search" 
                               placeholder="Enter category to search" 
                               autocomplete="off" 
                               required>
                        <button type="submit" class="absolute right-0 top-0 h-full px-3 text-white bg-emerald-600 hover:bg-emerald-700 rounded-r-lg transition-colors duration-200 flex items-center justify-center">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </form>

                <!-- Action Add Link -->
                <a href="{{ route('category.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors duration-200">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Add Category
                </a>
            </div>
        </div>

        <!-- Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th class="py-3 px-6">#</th>
                        <th class="py-3 px-6">Category</th>
                        <th class="py-3 px-6">Image</th>
                        <th class="py-3 px-6">Status</th>
                        <th class="py-3 px-6 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                    @if($list->count() > 0)
                        @foreach($list as $key => $item)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="py-4 px-6 font-medium text-gray-900">{{ ++$key }}</td>
                            <td class="py-4 px-6">{{ $item->category_name }}</td>
                            <td class="py-4 px-6">
                                <!-- Safe Image Render with Inline SVG Fallback -->
                                @if(!empty($item->image) && file_exists(public_path('category_logo/'.$item->image)))
                                    <img src="{{ asset('category_logo/'.$item->image) }}" 
                                         alt="{{ $item->category_name }}" 
                                         class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    
                                    <!-- Fallback block hidden by default, shown if image fails to load -->
                                    <div class="hidden w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 items-center justify-center text-gray-400" title="Image broken">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @else
                                    <!-- Default Placeholder Box when no image exists -->
                                    <div class="w-12 h-12 rounded-lg bg-gray-100 border border-gray-200 flex items-center justify-center text-gray-400" title="No Image Available">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-6">
                                @if($item->status == 1)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Active</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Inactive</span>
                                @endif
                            </td>
                            <td class="py-4 px-6 text-center">
                                <a title="Edit" href="{{ route('category.edit', $item->id) }}" class="inline-block text-indigo-600 hover:text-indigo-900 transition-colors duration-150">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="py-6 px-6 text-center text-gray-500 font-medium">No Data Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t border-gray-200 flex justify-end">
            {{ $list->links() }}
        </div>
    </div>
</div>
@endsection