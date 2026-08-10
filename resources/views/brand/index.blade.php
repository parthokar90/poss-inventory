@extends('admin.layouts.master')

@section('title', 'Dashboard | Brand')

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Include flash message notifications --}}
    @include('admin.includes.messages')

    <!-- Header Section -->
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-gray-800 uppercase">Brand Management</h1>
            <p class="text-sm text-gray-500">View and manage all registered brand details.</p>
        </div>
        <div>
            <a href="{{ route('brand.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg transition shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Brand
            </a>
        </div>
    </div>

    <!-- Main Table Container -->
    <div class="bg-white rounded-xl shadow-md border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/50">
            <h2 class="text-lg font-semibold text-gray-700">Brand Information List</h2>

            <!-- Search Form -->
            <form method="GET" action="{{ route('brand.index') }}" class="flex items-center gap-2 w-full sm:w-auto">
                <div class="relative w-full sm:w-64">
                    <input type="text" 
                           name="search" 
                           placeholder="Enter brand name..." 
                           autocomplete="off" 
                           required
                           class="w-full pl-9 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none transition">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition shadow-sm">
                    Search
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-100/70 text-gray-600 uppercase text-xs tracking-wider border-b border-gray-200">
                        <th class="py-3.5 px-4 font-semibold">#</th>
                        <th class="py-3.5 px-4 font-semibold">Brand Name</th>
                        <th class="py-3.5 px-4 font-semibold">Logo</th>
                        <th class="py-3.5 px-4 font-semibold">Status</th>
                        <th class="py-3.5 px-4 font-semibold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm text-gray-700">
                    @if($list->count() > 0)
                        @foreach($list as $key => $item)
                            <tr class="hover:bg-gray-50/80 transition">
                                <td class="py-3 px-4 font-medium text-gray-500">{{ ++$key }}</td>
                                <td class="py-3 px-4 font-semibold text-gray-800">{{ $item->name }}</td>
                                <td class="py-3 px-4">
                                    @if($item->image != '')
                                        <img class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm" 
                                             src="{{ asset('brand_logo/'.$item->image) }}" 
                                             alt="{{ $item->name }}">
                                    @else 
                                        <img class="w-12 h-12 object-cover rounded-lg border border-gray-200 shadow-sm opacity-60" 
                                             src="{{ asset('category_logo/no_image.png') }}" 
                                             alt="No Image Available">
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    @if($item->status == 1)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-rose-100 text-rose-800">
                                            Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <a title="Edit Brand" href="{{ route('brand.edit', $item->id) }}" class="inline-flex items-center justify-center p-2 text-indigo-600 hover:text-indigo-900 hover:bg-indigo-50 rounded-lg transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="py-8 text-center text-gray-500 font-medium">
                                No brands found. Try refining your search query or add a new brand.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        <div class="p-4 border-t border-gray-100 bg-gray-50/50 flex justify-end">
            {{ $list->links() }}
        </div>
    </div>
</div>
@endsection