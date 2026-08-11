{{-- Tax Rate List View (Index) --}}
@extends('admin.layouts.master')

@section('title') Dashboard | Tax Rate @endsection

@section('content')
<div class="container mx-auto px-4 py-6">
    {{-- Display Flash Messages --}}
    @include('admin.includes.messages')

    {{-- Page Header --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 uppercase tracking-wide">Tax Rate</h1>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
        
        {{-- Card Header: Title, Search Bar, and Action Button --}}
        <div class="px-6 py-4 border-b border-gray-200 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-lg font-semibold text-gray-700 uppercase">Tax Rate Information</h2>
            </div>

            <div class="flex flex-col sm:flex-row items-center gap-3">
                {{-- Search Form --}}
                <form method="GET" action="{{ route('taxrate.index') }}" class="flex items-center w-full sm:w-auto">
                    <div class="relative w-full sm:w-64">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Enter tax rate name to search" 
                            value="{{ request('search') }}"
                            autocomplete="off" 
                            required
                            class="w-full pl-3 pr-10 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <button 
                            type="submit" 
                            class="absolute right-1 top-1/2 -translate-y-1/2 p-1.5 text-gray-500 hover:text-blue-600 focus:outline-none"
                            title="Search"
                        >
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </button>
                    </div>
                </form>

                {{-- Add New Tax Rate Button --}}
                <a 
                    href="{{ route('taxrate.create') }}" 
                    class="w-full sm:w-auto inline-flex items-center justify-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg shadow-sm transition duration-150 ease-in-out"
                >
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Add Tax Rate
                </a>
            </div>
        </div>

        {{-- Card Body: Data Table --}}
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <th class="px-4 py-3">#</th>
                            <th class="px-4 py-3">Tax Rate</th>
                            <th class="px-4 py-3">Type</th>
                            <th class="px-4 py-3">Tax</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                        @if($list->count() > 0)
                            @foreach($list as $key => $item)
                                <tr class="hover:bg-gray-50 transition duration-150">
                                    <td class="px-4 py-3 font-medium text-gray-900">{{ ++$key }}</td>
                                    <td class="px-4 py-3">{{ $item->name }}</td>
                                    <td class="px-4 py-3">
                                        @if($item->type == 1)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                Percentage
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                Fixed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 font-semibold">
                                        @if($item->type == 1)
                                            {{ number_format($item->rate) }} %
                                        @else
                                            {{ number_format($item->rate) }} Tk
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($item->status == 1)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a 
                                            href="{{ route('taxrate.edit', $item->id) }}" 
                                            class="inline-flex items-center p-1.5 text-blue-600 hover:text-blue-800 hover:bg-blue-50 rounded-lg transition duration-150"
                                            title="Edit Tax Rate"
                                        >
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach 
                        @else 
                            <tr>
                                <td colspan="6" class="px-4 py-6 text-center text-gray-500 font-medium">
                                    No Data Found
                                </td>
                            </tr>
                        @endif 
                    </tbody>
                </table>
            </div>

            {{-- Pagination Links --}}
            <div class="mt-4 flex justify-end">
                {{ $list->links() }}
            </div>
        </div>

    </div>
</div>
@endsection